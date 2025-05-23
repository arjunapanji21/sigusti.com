<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
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
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        // Create test user
        User::create([
            'name' => 'User Test',
            'email' => 'user@user.com',
            'password' => bcrypt('user123'),
            'is_admin' => false,
        ]);

        // Create plans
        Plan::create([
            'name' => 'Basic',
            'description' => 'Cocok untuk penggunaan pribadi',
            'price' => 189900,
            'discount_percentage' => 50,
            'duration_days' => 30,
            'daily_limit' => 1000,
            'monthly_limit' => 30000,
            'max_device' => 1,
            'is_active' => true
        ]);
        Plan::create([
            'name' => 'Premium',
            'description' => 'Cocok untuk penggunaan pribadi dan tim kecil',
            'price' => 289900,
            'discount_percentage' => 50,
            'duration_days' => 30,
            'daily_limit' => 3000,
            'monthly_limit' => 60000,
            'max_device' => 2,
            'is_active' => true
        ]);
        Plan::create([
            'name' => 'Business',
            'description' => 'Cocok untuk penggunaan bisnis dan tim besar',
            'price' => 489900,
            'discount_percentage' => 50,
            'duration_days' => 30,
            'daily_limit' => 6000,
            'monthly_limit' => 120000,
            'max_device' => 4,
            'is_active' => true
        ]);
    }
}
