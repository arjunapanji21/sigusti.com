<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\License; // Add this line

class PaymentController extends Controller
{
    public function index()
    {
        $payments = auth()->user()->can('admin-actions')
            ? Payment::with(['user', 'plan'])->latest()->paginate(10)
            : Payment::where('user_id', auth()->id())->with(['plan'])->latest()->paginate(10);

        return view('pages.payments.index', compact('payments'));
    }

    public function create()
    {
        $plans = Plan::where('is_active', true)->get();
        $pendingPayment = Payment::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->whereNull('proof_of_payment')
            ->first();

        return view('pages.payments.create', compact('plans', 'pendingPayment'));
    }

    public function initiate(Request $request)
    {
        try {
            $request->validate([
                'plan_id' => 'required|exists:plans,id',
                'payment_method' => 'required|in:bank_transfer,ewallet',
            ]);

            $plan = Plan::findOrFail($request->plan_id);
            $price = $plan->isOnSale() ? $plan->sale_price : $plan->price;
            $expiresAt = now()->addHour();

            // Create inactive license
            $license = License::create([
                'user_id' => auth()->id(),
                'plan_id' => $plan->id,
                'license_key' => \Str::random(32),
                'expires_at' => now()->addDays($plan->duration_days),
                'daily_limit' => $plan->daily_limit,
                'monthly_limit' => $plan->monthly_limit,
                'daily_usage' => 0,
                'monthly_usage' => 0,
                'is_active' => false,
            ]);

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'plan_id' => $plan->id,
                'license_id' => $license->id, // Link payment to license
                'amount' => $price,
                'payment_method' => $request->payment_method,
                'status' => Payment::STATUS_PENDING,
                'reference_number' => 'PAY-' . strtoupper(uniqid()),
                'expires_at' => $expiresAt
            ]);

            if (!$payment->expires_at) {
                throw new \Exception('Failed to set payment expiration');
            }

            return redirect()->route('payments.upload', $payment);
            
        } catch (\Exception $e) {
            return redirect()->route('payments.create')
                ->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function showUpload(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        if ($payment->isExpired()) {
            return redirect()->route('payments.create')
                ->with('error', 'Payment session expired. Please start a new payment.');
        }

        return view('pages.payments.upload', compact('payment'));
    }

    public function uploadProof(Request $request, Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
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
                    'status' => Payment::STATUS_PROCESSING // Change status to processing after proof upload
                ]);

                if ($payment->license) {
                    $payment->license->activities()->create([
                        'activity_type' => 'payment_submitted',
                        'details' => 'Payment proof uploaded for plan: ' . $payment->plan->name
                    ]);
                }

                return redirect()->route('payments.show', $payment)
                    ->with('success', 'Payment proof uploaded successfully. Please wait for admin approval.');

            } catch (\Exception $e) {
                return back()->with('error', 'Failed to upload payment proof. Please try again.');
            }
        }

        return back()->with('error', 'No payment proof file uploaded.');
    }

    public function show(Payment $payment)
    {
        if (!auth()->user()->can('admin-actions') && $payment->user_id !== auth()->id()) {
            abort(403);
        }

        $payment->load(['user', 'plan']);
        return view('pages.payments.show', compact('payment'));
    }

    public function approve(Payment $payment)
    {
        $payment->approve();
        return back()->with('success', 'Payment approved successfully');
    }

    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'rejected']);
        return back()->with('success', 'Payment rejected successfully');
    }
}
