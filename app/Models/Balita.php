<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Balita extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tgl_lahir', 
        'gender',
        'ibu',
        'user_id'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tgl_lahir)->diffInMonths(Carbon::now());
    }
}
