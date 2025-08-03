<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use Illuminate\Support\Facades\File;

class MateriSeeder extends Seeder
{
    public function run()
    {
        // Read JSON file
        $jsonPath = public_path('backup/materis.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->warn('JSON file not found at: ' . $jsonPath);
            return;
        }

        $jsonContent = File::get($jsonPath);
        $data = json_decode($jsonContent, true);

        // Find the data array in the JSON structure
        $materiData = null;
        foreach ($data as $item) {
            if (isset($item['type']) && $item['type'] === 'table' && isset($item['data'])) {
                $materiData = $item['data'];
                break;
            }
        }

        if (!$materiData) {
            $this->command->warn('No materi data found in JSON file');
            return;
        }

        // Clear existing data
        Materi::truncate();

        // Insert data using the original table structure
        foreach ($materiData as $item) {
            Materi::create([
                'title' => $item['title'],
                'type' => $item['type'],
                'path' => $item['path'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
            ]);
        }

        $this->command->info('Materi seeder completed successfully! ' . count($materiData) . ' records inserted.');
    }
}
