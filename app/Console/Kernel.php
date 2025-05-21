protected function schedule(Schedule $schedule)
{
    // ...existing code...
    
    // Reset daily usage at midnight
    $schedule->command('license:reset-daily')->daily();
    
    // Reset monthly usage on first day of month
    $schedule->command('license:reset-monthly')->monthly();
}
