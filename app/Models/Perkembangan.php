<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    protected $fillable = [
        'bulan',
        'usia_bayi_id',
        'text',
        'gambar'
    ];

    public function usiaBayi()
    {
        return $this->belongsTo(UsiaBayi::class);
    }
}
