<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\LicenseActivity; // Add this import

class License extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'license_key',
        'expires_at',
        'daily_limit',
        'monthly_limit',
        'daily_usage',
        'monthly_usage',
        'is_active',
        'last_check'  // Add this field
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'last_check' => 'datetime'  // Add this cast
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function activities()
    {
        return $this->hasMany(LicenseActivity::class);
    }

    public function isValid()
    {
        return $this->is_active &&
               !$this->isExpired() &&
               !$this->isDailyLimitExceeded() &&
               !$this->isMonthlyLimitExceeded();
    }

    public function isExpired()
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }

    public function isDailyLimitExceeded()
    {
        return $this->daily_limit && $this->daily_usage >= $this->daily_limit;
    }

    public function isMonthlyLimitExceeded()
    {
        return $this->monthly_limit && $this->monthly_usage >= $this->monthly_limit;
    }
}
