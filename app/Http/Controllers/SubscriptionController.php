<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use App\Models\Activity;
use App\Models\Subscription;
use App\Exceptions\PaymentException;
use App\Traits\HandlesErrors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    use HandlesErrors;

    public function index()
    {
        if (auth()->user()?->is_admin) {
            $payments = Payment::with(['user', 'plan'])
                ->latest()
                ->paginate(10);
            return view('pages.subscription.index', compact('payments'));
        }

        $plans = Plan::query()
            ->where('is_active', true)
            ->get();

        $currentSubscription = Subscription::query()
            ->forUser(auth()->id())
            ->active()
            ->first();

        $userPayments = Payment::with(['plan'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
            
        return view('pages.subscription.index', compact('plans', 'currentSubscription', 'userPayments'));
    }

    public function purchase(Request $request, Plan $plan)
    {
        try {
            if (auth()->user()?->is_admin) {
                throw new PaymentException(
                    "Admin attempted to make purchase",
                    "Administrators cannot purchase subscriptions.",
                    "error"
                );
            }

            if (!$plan->exists || !$plan->is_active) {
                throw new PaymentException(
                    "Attempted to purchase inactive/non-existent plan",
                    "This plan is currently unavailable.",
                    "error"
                );
            }

            $validated = $request->validate([
                'payment_method' => [
                    'required',
                    'in:bank_transfer,e_wallet',
                ],
            ], [
                'payment_method.required' => 'Please select a payment method to continue.',
                'payment_method.in' => 'The selected payment method is not supported.',
            ]);

            $payment = DB::transaction(function () use ($request, $plan) {
                // Check for pending payments
                $pendingPayment = Payment::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->first();

                if ($pendingPayment) {
                    throw new PaymentException(
                        "User has pending payment",
                        "You have a pending payment. Please complete it before making a new purchase.",
                        "warning"
                    );
                }

                return Payment::create([
                    'user_id' => auth()->id(),
                    'plan_id' => $plan->id,
                    'amount' => $plan->price,
                    'payment_method' => $request->payment_method,
                    'status' => 'pending',
                    'reference_number' => 'PAY-' . strtoupper(uniqid()),
                ]);
            });

            // Log successful purchase initiation
            Log::info('Purchase initiated', [
                'user_id' => auth()->id(),
                'plan_id' => $plan->id,
                'payment_id' => $payment->id
            ]);

            return view('pages.payment.instructions', compact('payment', 'plan'))
                ->with('success', 'Purchase initiated successfully. Please follow the payment instructions.');

        } catch (\Exception $e) {
            return $this->handlePaymentError($e);
        }
    }

    public function confirmPayment(Request $request)
    {
        try {
            if (auth()->user()?->is_admin) {
                throw new PaymentException(
                    "Admin attempted to confirm payment",
                    "Administrators cannot submit payment confirmations.",
                    "error"
                );
            }

            $validated = $request->validate([
                'payment_id' => 'required|exists:payments,id',
                'proof_of_payment' => [
                    'required',
                    'image',
                    'max:2048',
                    'mimes:jpeg,png,jpg'
                ],
            ], [
                'proof_of_payment.required' => 'Please select a payment proof image to upload.',
                'proof_of_payment.image' => 'The uploaded file must be an image.',
                'proof_of_payment.max' => 'The image size must not exceed 2MB.',
                'proof_of_payment.mimes' => 'The image must be in JPEG, PNG, or JPG format.',
            ]);

            $payment = Payment::where('user_id', auth()->id())
                ->with('plan')
                ->findOrFail($validated['payment_id']);
            
            if ($payment->status !== 'pending') {
                throw new PaymentException(
                    "Invalid payment status for confirmation",
                    "This payment cannot be updated. Current status: {$payment->status}",
                    "error"
                );
            }

            DB::beginTransaction();
            try {
                // Handle file upload
                if ($payment->proof_of_payment) {
                    Storage::disk('public')->delete($payment->proof_of_payment);
                }

                $path = $request->file('proof_of_payment')->store('payment_proofs/' . date('Y/m'), 'public');
                
                // Update payment record
                $payment->update([
                    'proof_of_payment' => $path,
                ]);

                // Log activity
                Activity::create([
                    'user_id' => auth()->id(),
                    'description' => "Uploaded proof of payment for {$payment->plan->name}",
                    'type' => 'payment_proof_upload',
                    'properties' => [
                        'payment_id' => $payment->id,
                        'plan' => $payment->plan->name,
                        'amount' => $payment->amount
                    ]
                ]);

                DB::commit();

                return redirect()->route('subscription.index')
                    ->with('success', 'Payment proof submitted successfully. We will verify your payment within 24 hours.');

            } catch (\Exception $e) {
                DB::rollBack();
                if (isset($path) && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                throw $e;
            }
        } catch (\Exception $e) {
            return $this->handlePaymentError($e);
        }
    }

    public function verifyPayment(Request $request, Payment $payment)
    {
        try {
            if (!auth()->user()?->is_admin) {
                throw new PaymentException(
                    "Non-admin attempted to verify payment",
                    "Only administrators can verify payments.",
                    "error"
                );
            }

            $validated = $request->validate([
                'status' => 'required|in:approved,rejected',
                'notes' => 'nullable|string|max:500',
            ], [
                'status.required' => 'Please select a verification status.',
                'status.in' => 'Invalid verification status selected.',
                'notes.max' => 'Admin notes cannot exceed 500 characters.',
            ]);

            DB::transaction(function () use ($payment, $validated) {
                $oldStatus = $payment->status;
                
                $payment->update([
                    'status' => $validated['status'],
                    'admin_notes' => $validated['notes'] ?? null,
                ]);

                if ($validated['status'] === 'approved' && $payment->plan) {
                    $subscription = Subscription::updateOrCreate(
                        ['user_id' => $payment->user_id],
                        [
                            'plan_id' => $payment->plan_id,
                            'starts_at' => now(),
                            'expires_at' => now()->addDays($payment->plan->duration_days ?? 30),
                            'status' => 'active',
                            'license_key' => function($subscription) {
                                return $subscription->generateLicenseKey();
                            },
                        ]
                    );
                    
                    // Update payment with subscription_id
                    $payment->update(['subscription_id' => $subscription->id]);

                    // Log successful subscription activation
                    Log::info('Subscription activated', [
                        'user_id' => $payment->user_id,
                        'plan_id' => $payment->plan_id,
                        'payment_id' => $payment->id
                    ]);
                }

                // Log payment verification
                Activity::create([
                    'user_id' => auth()->id(),
                    'description' => "Payment {$validated['status']} for user {$payment->user->name}",
                    'type' => 'payment_verification',
                    'properties' => [
                        'payment_id' => $payment->id,
                        'old_status' => $oldStatus,
                        'new_status' => $validated['status'],
                        'notes' => $validated['notes'] ?? null
                    ]
                ]);
            });

            $message = $validated['status'] === 'approved' 
                ? 'Payment approved and subscription activated successfully.'
                : 'Payment rejected. User has been notified.';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return $this->handlePaymentError($e);
        }
    }

    public function show(Payment $payment)
    {
        try {
            if (!auth()->user()?->is_admin && $payment->user_id !== auth()->id()) {
                throw new PaymentException(
                    "Unauthorized payment details access",
                    "You are not authorized to view this payment details.",
                    "error"
                );
            }

            return view('pages.subscription.payment-details', compact('payment'));

        } catch (\Exception $e) {
            return $this->handlePaymentError($e);
        }
    }
}
