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
        \App\Console\Commands\CareUpdate::class,
        \App\Console\Commands\SleepUpdate::class,
        \App\Console\Commands\SleepFastUpdate::class,
        \App\Console\Commands\HungryUpdate::class,
        \App\Console\Commands\HungryFastUpdate::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:hungry_update')->everyTenMinutes();
        $schedule->command('command:sleep_update')->cron('*/20 * * * *');
        $schedule->command('command:care_update')->cron('*/15 * * * *');

        $schedule->command('command:hungry_fast_update')->cron('*/15 * * * *');
        $schedule->command('command:sleep_fast_update')->cron('*/5 * * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
