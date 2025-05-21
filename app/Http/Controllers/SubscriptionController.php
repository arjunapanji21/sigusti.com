<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('subscription', compact('plans'));
    }

    public function purchase(Request $request, Plan $plan)
    {
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'reference_number' => 'PAY-' . strtoupper(uniqid()),
        ]);

        return view('payment.instructions', compact('payment', 'plan'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        $payment = Payment::findOrFail($request->payment_id);
        
        $path = $request->file('proof_of_payment')->store('payment_proofs', 'public');
        
        $payment->update([
            'proof_of_payment' => $path,
            'status' => 'processing'
        ]);

        return redirect()->route('subscription')
            ->with('success', 'Payment proof submitted successfully. We will verify your payment shortly.');
    }
}
