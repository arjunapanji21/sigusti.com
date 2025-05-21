<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'user_id',
        'license_key',
        'expires_at',
        'daily_limit',
        'monthly_limit', 
        'daily_usage',
        'monthly_usage',
        'is_active',
        'last_check'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'last_check' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid()
    {
        return $this->is_active && 
               $this->expires_at->isFuture() &&
               $this->daily_usage < $this->daily_limit &&
               $this->monthly_usage < $this->monthly_limit;
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function logActivity($type, $description)
    {
        return $this->activities()->create([
            'type' => $type,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
