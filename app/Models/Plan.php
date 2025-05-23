<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_percentage',
        'duration_days',
        'daily_limit',
        'monthly_limit',
        'max_device',
        'is_active'
    ];

    protected $casts = [
        'price' => 'string',
        'discount_percentage' => 'integer',
        'duration_days' => 'integer',
        'daily_limit' => 'integer',
        'monthly_limit' => 'integer',
        'max_device' => 'integer',
        'is_active' => 'boolean'
    ];

    // Scope for active plans
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getSalePriceAttribute()
    {
        if (!$this->discount_percentage) {
            return $this->price;
        }
        return (int) ($this->price * (100 - $this->discount_percentage) / 100);
    }

    public function isOnSale()
    {
        return $this->discount_percentage > 0;
    }

    public function getDiscountBadgeAttribute()
    {
        return $this->isOnSale() ? "Save {$this->discount_percentage}%" : null;
    }

    public function getOriginalPriceFormattedAttribute()
    {
        return 'Rp. ' . number_format($this->price);
    }

    public function getSalePriceFormattedAttribute()
    {
        return 'Rp. ' . number_format($this->sale_price);
    }
}
