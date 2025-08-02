<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_balita',
        'tgl_lahir',
        'usia_saat_pemeriksaan',
        'gender',
        'nama_ibu',
        'berat',
        'panjang',
        'kode_pertumbuhan',
        'kode_rekomendasi',
        'kode_tindakan_perkembangan',
        'jadwal_pertumbuhan',
        'jadwal_perkembangan',
        'jawaban_array'
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'jadwal_pertumbuhan' => 'date',
        'jadwal_perkembangan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'nama_balita', 'name');
    }
}
