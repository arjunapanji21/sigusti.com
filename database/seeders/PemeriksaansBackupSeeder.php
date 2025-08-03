<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\File;

class PemeriksaansBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/pemeriksaans.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $pemeriksaanData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'pemeriksaans' && 
                    isset($section['data'])) {
                    $pemeriksaanData = $section['data'];
                    break;
                }
            }
            
            if (is_array($pemeriksaanData)) {
                foreach ($pemeriksaanData as $data) {
                    Pemeriksaan::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'user_id' => $data['user_id'],
                            'nama_balita' => $data['nama_balita'],
                            'tgl_lahir' => $data['tgl_lahir'],
                            'usia_saat_pemeriksaan' => $data['usia_saat_pemeriksaan'],
                            'gender' => $data['gender'],
                            'nama_ibu' => $data['nama_ibu'],
                            'berat' => $data['berat'],
                            'panjang' => $data['panjang'],
                            'kode_pertumbuhan' => $data['kode_pertumbuhan'],
                            'kode_rekomendasi' => $data['kode_rekomendasi'],
                            'kode_tindakan_perkembangan' => $data['kode_tindakan_perkembangan'],
                            'jadwal_pertumbuhan' => $data['jadwal_pertumbuhan'],
                            'jadwal_perkembangan' => $data['jadwal_perkembangan'],
                            'jawaban_array' => $data['jawaban_array'],
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Pemeriksaans backup data seeded successfully: ' . count($pemeriksaanData) . ' records.');
            } else {
                $this->command->warn('No pemeriksaans data found in backup file.');
            }
        } else {
            $this->command->warn('Pemeriksaans backup file not found at: ' . $backupPath);
        }
    }
}
