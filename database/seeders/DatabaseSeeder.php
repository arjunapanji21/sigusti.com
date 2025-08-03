<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsiaBayiSeeder::class,
            PerkembanganSeeder::class,
            MateriSeeder::class,
            BalitasBackupSeeder::class,
            ChatsBackupSeeder::class,
            PemeriksaansBackupSeeder::class,
            UsersBackupSeeder::class,
            UsiaBayisBackupSeeder::class,
            StandarBbsBackupSeeder::class,
            WilayahsBackupSeeder::class,
        ]);

        $users = User::all();

        $totalUsers = $users->count();
        $this->command->info("Starting password update for {$totalUsers} users");
        
        foreach($users as $index => $user){
            $currentCount = $index + 1;
            $this->command->info("({$currentCount}/{$totalUsers}) Updating password for user: {$user->email}");
            $user->password = bcrypt('password123');
            $user->save();
        }
        $this->command->info("Password update completed for {$totalUsers} users");
    }
}
