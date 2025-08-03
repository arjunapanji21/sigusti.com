<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StandarBb;
use Illuminate\Support\Facades\File;

class StandarBbsBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/standar_bbs.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $standarBbsData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'standar_bbs' && 
                    isset($section['data'])) {
                    $standarBbsData = $section['data'];
                    break;
                }
            }
            
            if (is_array($standarBbsData)) {
                foreach ($standarBbsData as $data) {
                    StandarBb::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'jenis_kelamin' => $data['jenis_kelamin'],
                            'umur' => $data['umur'],
                            'm3' => $data['m3'],
                            'm2' => $data['m2'],
                            'm1' => $data['m1'],
                            'median' => $data['median'],
                            'p1' => $data['p1'],
                            'p2' => $data['p2'],
                            'p3' => $data['p3'],
                        ]
                    );
                }
                
                $this->command->info('Standar BBs backup data seeded successfully: ' . count($standarBbsData) . ' records.');
            } else {
                $this->command->warn('No standar_bbs data found in backup file.');
            }
        } else {
            $this->command->warn('Standar BBs backup file not found at: ' . $backupPath);
        }
    }
}
