<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemEvent extends Model
{
    protected $fillable = [
        'type',
        'message',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
