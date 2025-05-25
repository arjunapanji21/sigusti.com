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
            'name' => 'Tester',
            'email' => 'test@test.com',
            'phone' => '1', // Added phone number
            'password' => bcrypt('test123'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);

        // Create payment methods
        PaymentMethod::create([
            'type' => 'bank_transfer',
            'provider' => 'BRI',
            'account_number' => '227701007757506',
            'account_name' => 'Arjun Panji Prakarsa'
        ]);
        PaymentMethod::create([
            'type' => 'bank_transfer',
            'provider' => 'BCA',
            'account_number' => '8190587607',
            'account_name' => 'Arjuna Panji Prakarsa'
        ]);
        PaymentMethod::create([
            'type' => 'e-wallet',
            'provider' => 'DANA',
            'account_number' => '081271310334',
            'account_name' => 'Arjuna Panji Prakarsa'
        ]);
        PaymentMethod::create([
            'type' => 'e-wallet',
            'provider' => 'GoPay',
            'account_number' => '081271310334',
            'account_name' => 'Arjuna Panji Prakarsa'
        ]);

        // Create plans
        Plan::create([
            'name' => 'Free Trial',
            'description' => 'Percobaan gratis selama 14 hari', // Updated description
            'price' => 0,
            'discount_percentage' => 0,
            'duration_days' => 14, // Changed from 7 to 14
            'daily_limit' => 150,
            'monthly_limit' => 1000,
            'max_device' => 1,
            'is_active' => true
        ]);
        Plan::create([
            'name' => 'Basic',
            'description' => 'Cocok untuk penggunaan pribadi',
            'price' => 99000,
            'discount_percentage' => 30,
            'duration_days' => 30,
            'daily_limit' => 2000,
            'monthly_limit' => 50000,
            'max_device' => 1,
            'is_active' => true
        ]);
        Plan::create([
            'name' => 'Premium',
            'description' => 'Cocok untuk penggunaan pribadi dan bisnis skala kecil',
            'price' => 247500,
            'discount_percentage' => 40,
            'duration_days' => 30,
            'daily_limit' => 5000,
            'monthly_limit' => 125000,
            'max_device' => 2,
            'is_active' => true
        ]);
        Plan::create([
            'name' => 'Business',
            'description' => 'Cocok untuk penggunaan bisnis skala besar',
            'price' => 495000,
            'discount_percentage' => 30,
            'duration_days' => 30,
            'daily_limit' => 10000,
            'monthly_limit' => 250000,
            'max_device' => 4,
            'is_active' => true
        ]);
    }
}
