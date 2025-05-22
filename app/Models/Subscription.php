<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'starts_at',
        'expires_at',
        'status',
        'license_key'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Scope for active subscriptions
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active')
            ->where('starts_at', '<=', now())
            ->where('expires_at', '>', now());
    }

    // Scope for a specific user's subscriptions
    public function scopeForUser(Builder $query, ?int $userId): Builder
    {
        return $query->when($userId, function ($q) use ($userId) {
            return $q->where('user_id', $userId);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // Helper method to check if subscription is active
    public function isActive(): bool
    {
        return $this->status === 'active' 
            && $this->starts_at?->lte(now()) 
            && $this->expires_at?->gt(now());
    }

    public function isExpiringSoon()
    {
        return $this->expires_at->diffInDays(now()) <= 7;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function generateLicenseKey(): string
    {
        return 'LIC-' . strtoupper(uniqid()) . '-' . substr(sha1($this->id . time()), 0, 8);
    }
}
