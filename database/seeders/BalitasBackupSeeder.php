<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balita;
use Illuminate\Support\Facades\File;

class BalitasBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/balitas.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $balitaData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'balitas' && 
                    isset($section['data'])) {
                    $balitaData = $section['data'];
                    break;
                }
            }
            
            if (is_array($balitaData)) {
                foreach ($balitaData as $data) {
                    Balita::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'name' => $data['name'],
                            'tgl_lahir' => $data['tgl_lahir'],
                            'gender' => $data['gender'],
                            'ibu' => $data['ibu'],
                            'user_id' => $data['user_id'],
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Balitas backup data seeded successfully: ' . count($balitaData) . ' records.');
            } else {
                $this->command->warn('No balitas data found in backup file.');
            }
        } else {
            $this->command->warn('Balitas backup file not found at: ' . $backupPath);
        }
    }
}
