protected function schedule(Schedule $schedule): void
{
    // Reset daily usage at midnight
    $schedule->command('license:reset-daily')->daily();
    
    // Reset monthly usage on first day of month
    $schedule->command('license:reset-monthly')->monthly();
    
    // Run every 5 minutes to check for expired payments
    $schedule->command('payments:cancel-expired')
            ->everyFiveMinutes();
}
