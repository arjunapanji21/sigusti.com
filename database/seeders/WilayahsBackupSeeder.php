<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;
use Illuminate\Support\Facades\File;

class WilayahsBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/wilayahs.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $wilayahsData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'wilayahs' && 
                    isset($section['data'])) {
                    $wilayahsData = $section['data'];
                    break;
                }
            }
            
            if (is_array($wilayahsData)) {
                foreach ($wilayahsData as $data) {
                    Wilayah::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'name' => $data['name'],
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Wilayahs backup data seeded successfully: ' . count($wilayahsData) . ' records.');
            } else {
                $this->command->warn('No wilayahs data found in backup file.');
            }
        } else {
            $this->command->warn('Wilayahs backup file not found at: ' . $backupPath);
        }
    }
}
