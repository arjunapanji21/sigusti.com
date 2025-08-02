<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perkembangan;
use Illuminate\Support\Facades\File;

class PerkembanganSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        Perkembangan::truncate();

        // Read the JSON file
        $jsonPath = 'C:\Users\arjun_000\Downloads\perkembangans.json';
        
        if (!file_exists($jsonPath)) {
            $this->command->error('perkembangans.json file not found in Downloads folder');
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);

        // Extract the data array from the JSON structure
        if (isset($data[2]['data'])) {
            $perkembanganData = $data[2]['data'];
            
            foreach ($perkembanganData as $item) {
                Perkembangan::create([
                    'bulan' => $item['bulan'],
                    'usia_bayi_id' => $item['usia_bayi_id'],
                    'text' => $item['text'],
                    'gambar' => $item['gambar'] ?: null,
                ]);
            }
            
            $this->command->info('KPSP questions seeded successfully: ' . count($perkembanganData) . ' records.');
        } else {
            $this->command->error('Invalid JSON structure in perkembangans.json');
        }
    }
}
