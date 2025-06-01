<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '0', // Added phone number
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'phone' => '1', // Added phone number
            'password' => bcrypt('user123'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);
    }
}
