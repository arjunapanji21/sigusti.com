<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chat;
use Illuminate\Support\Facades\File;

class ChatsBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $backupPath = public_path('backup/chats.json');
        
        if (File::exists($backupPath)) {
            $jsonData = File::get($backupPath);
            $backupData = json_decode($jsonData, true);
            
            // Find the table data section
            $chatsData = null;
            foreach ($backupData as $section) {
                if (isset($section['type']) && $section['type'] === 'table' && 
                    isset($section['name']) && $section['name'] === 'chats' && 
                    isset($section['data'])) {
                    $chatsData = $section['data'];
                    break;
                }
            }
            
            if (is_array($chatsData)) {
                foreach ($chatsData as $data) {
                    Chat::updateOrCreate(
                        ['id' => $data['id']],
                        [
                            'from_user_id' => $data['from_user_id'],
                            'to_user_id' => $data['to_user_id'],
                            'message' => $data['message'],
                            'isAdmin' => (bool) $data['isAdmin'],
                            'seen' => (bool) $data['seen'],
                            'created_at' => $data['created_at'] ?? now(),
                            'updated_at' => $data['updated_at'] ?? now(),
                        ]
                    );
                }
                
                $this->command->info('Chats backup data seeded successfully: ' . count($chatsData) . ' records.');
            } else {
                $this->command->warn('No chats data found in backup file.');
            }
        } else {
            $this->command->warn('Chats backup file not found at: ' . $backupPath);
        }
    }
}
