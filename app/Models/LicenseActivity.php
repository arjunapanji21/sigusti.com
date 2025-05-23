<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseActivity extends Model
{
    protected $fillable = [
        'license_id',
        'activity_type',
        'details'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
