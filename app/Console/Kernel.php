<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CheckForExchange;
use App\Console\Commands\CheckForNewsTopic;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckForExchange::class,
        CheckForNewsTopic::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->command('check:exchange usd cad')
            ->cron(config('newsbox.exchange.cron.exchange_schedule'))
            ->appendOutputTo('/tmp/laravel-cron');

        $schedule
            ->command('check:news water')
            ->cron(config('newsbox.newstopic.cron.newstopic_schedule'))
            ->appendOutputTo('/tmp/laravel-cron');
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
