<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailVerification;
use App\Models\License;
use App\Models\Plan;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice(){
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.verify-email');
    }
    
    public function verify($token)
    {
        $verified = EmailVerification::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verified) {
            return redirect()->route('signin')
                ->with('error', 'Invalid verification token.');
        }

        // generate free license key
        $plan = Plan::where('name', 'Free Trial')->first();
        $license = License::create([
            'user_id' => $verified->user->id,
            'plan_id' => $plan->id,
            'license_key' => \Str::random(32),
            'expires_at' => now()->addDays($plan->duration_days),
            'daily_limit' => $plan->daily_limit,
            'monthly_limit' => $plan->monthly_limit,
            'daily_usage' => 0,
            'monthly_usage' => 0,
            'is_active' => true,
        ]);

        $verified->user->markEmailAsVerified();

        // Optionally delete the token after verification
        $verified->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Email verified successfully! Thank you for signing up and enjoy a 14 day free trial.');
    }

    public function resend()
    {
        $user = User::find(auth()->user()->id);
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        if ($user && !$user->email_verified_at) {
            $user->sendEmailVerificationNotification();
            return back()->with('success', 'Verification link sent!');
        }

        return back()->with('error', 'Unable to send verification link.');
    }
}