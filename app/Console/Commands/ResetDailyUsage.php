<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\License;

class ResetDailyUsage extends Command
{
    protected $signature = 'license:reset-daily';
    protected $description = 'Reset daily usage for all licenses';

    public function handle()
    {
        License::query()->update(['daily_usage' => 0]);
        $this->info('Daily usage reset successfully');
    }
}
