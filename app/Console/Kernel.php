<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendProjectAlert::class,
        Commands\InsertUmin::class,
        Commands\InsertJapic::class,
        Commands\InsertJMACCT::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('project-alert:send')->dailyAt('8:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
