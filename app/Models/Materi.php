<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type', 
        'path'
    ];

    public function getKategoriLabelAttribute()
    {
        // Since we don't have kategori in the original table, 
        // we'll determine it based on title
        $title = strtolower($this->title);
        
        if (str_contains($title, 'pertumbuhan') || str_contains($title, 'perkembangan') || str_contains($title, 'keterlambatan')) {
            return 'Tumbuh Kembang';
        }
        
        if (str_contains($title, 'stimulasi')) {
            return 'Stimulasi';
        }
        
        if (str_contains($title, 'mengukur') || str_contains($title, 'menimbang') || str_contains($title, 'berat') || str_contains($title, 'tinggi')) {
            return 'Kesehatan';
        }
        
        return 'Tumbuh Kembang';
    }

    public function getUsiaTargetAttribute()
    {
        $title = strtolower($this->title);
        
        if (str_contains($title, '0-2 tahun') || str_contains($title, 'bayi')) {
            return '0-24 bulan';
        }
        
        if (str_contains($title, '2 tahun ke atas')) {
            return '24+ bulan';
        }
        
        return '0-60 bulan';
    }

    public function getDeskripsiAttribute()
    {
        $descriptions = [
            'Pengertian Pertumbuhan dan Perkembangan' => 'Video edukatif yang menjelaskan perbedaan antara pertumbuhan dan perkembangan anak, serta pentingnya memahami kedua aspek ini dalam tumbuh kembang balita.',
            'Dampak Keterlambatan Perkembangan' => 'Materi yang membahas berbagai dampak yang dapat terjadi akibat keterlambatan perkembangan pada anak dan cara pencegahannya.',
            'Pentingnya Stimulasi' => 'Penjelasan komprehensif tentang pentingnya memberikan stimulasi yang tepat untuk mendukung perkembangan optimal anak.',
            'Mengukur Tinggi Badan Anak Usia 2 Tahun ke Atas' => 'Panduan praktis cara mengukur tinggi badan anak usia 2 tahun ke atas dengan teknik yang benar dan akurat.',
            'Mengukur Panjang Badan Bayi & Anak 0-2 Tahun' => 'Tutorial langkah demi langkah mengukur panjang badan bayi dan anak usia 0-2 tahun menggunakan alat ukur yang tepat.',
            'Menimbang Berat Badan Anak menggunakan Timbangan Digital' => 'Cara yang benar menimbang berat badan anak menggunakan timbangan digital untuk hasil yang akurat.',
            'Menimbang Berat Badan Anak Menggunakan Dacin' => 'Teknik menimbang berat badan anak menggunakan dacin (timbangan manual) dengan prosedur yang tepat.',
            'Menimbang Berat Badang Anak Menggunakan BabyScale' => 'Panduan penggunaan baby scale untuk menimbang berat badan bayi dengan aman dan akurat.'
        ];

        return $descriptions[$this->title] ?? 'Materi edukatif untuk mendukung tumbuh kembang optimal anak.';
    }
}
