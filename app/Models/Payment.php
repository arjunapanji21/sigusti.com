<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id',
        'plan_id',
        'subscription_id',
        'amount',
        'payment_method',
        'status',
        'reference_number',
        'proof_of_payment',
        'admin_notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scope for pending payments
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    // Scope for processing payments
    public function scopeProcessing(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    // Scope for a specific user's payments
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

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Check if payment can be processed
    public function canBeProcessed(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    // Check if payment is approved
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    // Check if payment is rejected
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    // Check if payment belongs to user
    public function belongsToUser(?int $userId): bool
    {
        return $this->user_id === $userId;
    }
}
