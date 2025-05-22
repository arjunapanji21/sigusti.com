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

        // Create default plans
        Plan::create([
            'name' => 'Basic Plan',
            'price' => 99.00,
            'duration_days' => 30,
            'features' => ['Feature 1', 'Feature 2'],
            'is_active' => true
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'price' => 199.00,
            'duration_days' => 30,
            'features' => ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4'],
            'is_active' => true
        ]);

        Plan::create([
            'name' => 'Enterprise Plan',
            'price' => 299.00,
            'duration_days' => 30,
            'features' => ['Feature 1', 'Feature 2', 'Feature 3', 'Feature 4', 'Feature 5'],
            'is_active' => true
        ]);
    }
}
