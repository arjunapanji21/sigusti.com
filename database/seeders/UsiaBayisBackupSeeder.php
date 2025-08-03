<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsiaBayi;
use Illuminate\Support\Facades\File;

class UsiaBayisBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/usia_bayis.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $usiaBayisData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'usia_bayis' && 
                    isset($section['data'])) {
                    $usiaBayisData = $section['data'];
                    break;
                }
            }
            
            if (is_array($usiaBayisData)) {
                foreach ($usiaBayisData as $data) {
                    UsiaBayi::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'rentang' => $data['rentang'],
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Usia Bayis backup data seeded successfully: ' . count($usiaBayisData) . ' records.');
            } else {
                $this->command->warn('No usia_bayis data found in backup file.');
            }
        } else {
            $this->command->warn('Usia Bayis backup file not found at: ' . $backupPath);
        }
    }
}
