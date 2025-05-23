<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    // Use HasApiTokens only if API functionality is needed
    // use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sendEmailVerificationNotification()
    {
        $token = Str::random(60);
        
        // Create an email verification record
        EmailVerification::create([
            'user_id' => $this->id,
            'token' => $token,
            'expires_at' => now()->addHours(24)
        ]);
        
        $verificationUrl = route('verification.verify', ['token' => $token]);
        $this->notify(new VerifyEmailNotification($verificationUrl));
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }
}
