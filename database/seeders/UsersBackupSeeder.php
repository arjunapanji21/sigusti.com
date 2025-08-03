<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/users.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $usersData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'users' && 
                    isset($section['data'])) {
                    $usersData = $section['data'];
                    break;
                }
            }
            
            if (is_array($usersData)) {
                foreach ($usersData as $data) {
                    User::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'name' => $data['name'],
                            'tgl_lahir' => $data['tgl_lahir'] ?? null,
                            'gender' => $data['gender'] ?? null,
                            'alamat' => $data['alamat'] ?? null,
                            'email' => $data['email'] ?? null,
                            'email_verified_at' => $data['email_verified_at'] ?? null,
                            'telp' => $data['telp'] ?? null,
                            'otp' => $data['otp'] ?? null,
                            'role' => $data['role'] ?? 'user',
                            'password' => $data['password'], // Already hashed in backup
                            'remember_token' => $data['remember_token'] ?? null,
                            'wilayah_id' => $data['wilayah_id'] ?? null,
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Users backup data seeded successfully: ' . count($usersData) . ' records.');
            } else {
                $this->command->warn('No users data found in backup file.');
            }
        } else {
            $this->command->warn('Users backup file not found at: ' . $backupPath);
        }
    }
}
