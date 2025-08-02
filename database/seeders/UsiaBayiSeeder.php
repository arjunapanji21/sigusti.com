<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsiaBayi;
use Illuminate\Support\Facades\DB;

class UsiaBayiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'rentang' => 3],
            ['id' => 2, 'rentang' => 6],
            ['id' => 3, 'rentang' => 9],
            ['id' => 4, 'rentang' => 12],
            ['id' => 5, 'rentang' => 15],
            ['id' => 6, 'rentang' => 18],
            ['id' => 7, 'rentang' => 21],
            ['id' => 8, 'rentang' => 24],
            ['id' => 9, 'rentang' => 30],
            ['id' => 10, 'rentang' => 36],
            ['id' => 11, 'rentang' => 42],
            ['id' => 12, 'rentang' => 48],
            ['id' => 13, 'rentang' => 54],
            ['id' => 14, 'rentang' => 60],
        ];

        foreach ($data as $item) {
            UsiaBayi::updateOrCreate(
                ['id' => $item['id']],
                ['rentang' => $item['rentang']]
            );
        }

        $this->command->info('UsiaBayi seeded successfully: ' . count($data) . ' records.');
    }
}
