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
        'is_active'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean'
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
}
