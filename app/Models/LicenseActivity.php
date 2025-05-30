<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseActivity extends Model
{
    protected $fillable = [
        'license_id',
        'ip_address',
        'mac_address',
        'user_agent',
        'activity_type',
        'details'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
