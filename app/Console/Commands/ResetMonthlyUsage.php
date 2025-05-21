<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\License;

class ResetMonthlyUsage extends Command
{
    protected $signature = 'license:reset-monthly';
    protected $description = 'Reset monthly usage for all licenses';

    public function handle()
    {
        License::query()->update(['monthly_usage' => 0]);
        $this->info('Monthly usage reset successfully');
    }
}
