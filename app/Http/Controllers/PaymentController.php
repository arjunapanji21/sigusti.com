<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\License;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF; // Updated import

class PaymentController extends Controller
{
    public function index()
    {
        $payments = auth()->user()->can('admin-actions')
            ? Payment::with(['user', 'plan'])->latest()->paginate(10)
            : Payment::where('user_id', auth()->user()->id)->with(['plan'])->latest()->paginate(10);

        return view('pages.payments.index', compact('payments'));
    }

    public function create()
    {
        // get active plans except for the one with id 1
        $plans = Plan::active()->orderBy('price')
            ->get();
        $pendingPayment = Payment::where('user_id', auth()->user()->id)
            ->where('status', Payment::STATUS_PENDING_PAYMENT)
            ->whereNull('proof_of_payment')
            ->first();
        
        $bankTransfers = PaymentMethod::where('type', 'bank_transfer')->get();
        $ewallets = PaymentMethod::where('type', 'e-wallet')->get();

        return view('pages.payments.create', compact('plans', 'pendingPayment', 'bankTransfers', 'ewallets'));
    }

    public function initiate(Request $request)
    {
        try {
            $request->validate([
                'plan_id' => 'required|exists:plans,id',
                'payment_frequency' => 'required|in:monthly,yearly',
                'payment_method_id' => 'required|exists:payment_methods,id',
            ]);

            $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);
            $plan = Plan::findOrFail($request->plan_id);
            $price = $request->payment_frequency == 'yearly' 
            ? $plan->yearly_price 
            : ($plan->isOnSale() ? $plan->sale_price : $plan->price);
            
            $durationDays = $request->payment_frequency == 'yearly' 
            ? $plan->duration_days * 12 
            : $plan->duration_days;
            
            $expiresAt = now()->addHour();
        
            // Create inactive license
            $license = License::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'license_key' => \Str::random(32),
                'expires_at' => now()->addDays($durationDays),
                'daily_limit' => $plan->daily_limit,
                'monthly_limit' => $plan->monthly_limit,
                'max_device' => $plan->max_device,
                'daily_usage' => 0,
                'monthly_usage' => 0,
                'is_active' => false,
            ]);

            $payment = Payment::create([
                'user_id' => auth()->user()->id,
                'plan_id' => $plan->id,
                'license_id' => $license->id,
                'payment_method_id' => $request->payment_method_id,
                'amount' => $price + ($price * config('app.tax_percentage') / 100),
                'payment_frequency' => $request->payment_frequency,
                'status' => Payment::STATUS_PENDING_PAYMENT,
                'reference_number' => 'PAY-' . strtoupper(uniqid()),
                'expires_at' => $expiresAt
            ]);

            if (!$payment->expires_at) {
                throw new \Exception('Failed to set payment expiration');
            }

            return redirect()->route('payments.upload', $payment);
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('payments.create')
                ->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function showUpload(Payment $payment)
    {
        if ($payment->user_id != auth()->user()->id) {
            abort(403);
        }

        if ($payment->isExpired()) {
            return redirect()->route('payments.create')
                ->with('error', 'Payment session expired. Please start a new payment.');
        }

        $payment->load(['plan', 'paymentMethod']);
        return view('pages.payments.upload', compact('payment'));
    }

    public function uploadProof(Request $request, Payment $payment)
    {
        if ($payment->user_id != auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('proof')) {
            try {
                $path = $request->file('proof')->store('payment-proofs', 'public');
                
                $payment->update([
                    'proof_of_payment' => $path,
                    'status' => Payment::STATUS_PENDING_APPROVAL
                ]);

                if ($payment->license) {
                    $payment->license->activities()->create([
                        'activity_type' => 'payment_submitted',
                        'details' => 'Payment proof uploaded for plan: ' . $payment->plan->name,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]);
                }

                return redirect()->route('payments.index')
                    ->with('success', 'Payment proof uploaded successfully. Please wait for admin approval.');

            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload payment proof. Please try again.');
            }
        }

        return back()->with('error', 'No payment proof file uploaded.');
    }

    public function show(Payment $payment)
    {
        if (!auth()->user()->can('admin-actions') && $payment->user_id != auth()->user()->id) {
            abort(403);
        }

        $payment->load(['user', 'plan']);
        return view('pages.payments.show', compact('payment'));
    }

    public function approve(Payment $payment)
    {
        $license = $payment->license;
        $license->is_active = true;
        $license->save();
        $payment->approve();
        return back()->with('success', 'Payment approved successfully');
    }

    public function reject(Payment $payment)
    {
        // remove the license if it exists
        if ($payment->license) {
            $payment->license->delete();
        }
        // update the payment status
        $payment->license_id = null; // remove the license association
        $payment->update(['status' => 'rejected']);
        return back()->with('success', 'Payment rejected successfully');
    }

    public function downloadInvoice(Payment $payment)
    {
        if (!auth()->user()->can('admin-actions') && $payment->user_id != auth()->user()->id) {
            abort(403);
        }

        $payment->load(['user', 'plan', 'paymentMethod']);
        
        $pdf = PDF::loadView('pages.payments.invoice', compact('payment'));
        
        return $pdf->download('invoice-' . $payment->reference_number . '.pdf');
    }
}
