<?php

namespace App\Console;

use App\Console\Commands\ParseEmailCommand;
use App\Console\Commands\ScanUserPlanExpiredCommand;
use App\Console\Commands\SendNewsLetter;
use App\Models\SendUnpaidEmail;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->command(ScanUserPlanExpiredCommand::class)->daily()->withoutOverlapping();
        $schedule->command(ParseEmailCommand::class)->everyFiveMinutes()->withoutOverlapping();
        $schedule->command(SendNewsLetter::class)->everyFiveMinutes()->withoutOverlapping();
        //$schedule->command(SendUnpaidEmail::class)->everyFiveMinutes()->withoutOverlapping();
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
