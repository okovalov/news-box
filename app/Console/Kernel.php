<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CheckForExchange;
use App\Console\Commands\CheckForNewsTopic;
use App\Console\Commands\CheckForWeather;

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
        CheckForWeather::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $pairsList = config('newsbox.exchange.currency_pairs_list');

        foreach ($pairsList as $pair) {
            $command = sprintf('check:exchange %s', $pair);

            $schedule
                ->command($command)
                ->cron(config('newsbox.exchange.cron.exchange_schedule'))
                ->appendOutputTo('/tmp/laravel-cron');
        }

        $subjectsList = config('newsbox.newstopic.subjects_list');

        foreach ($subjectsList as $subject) {
            $schedule
                ->command(CheckForNewsTopic::class, [$subject])
                ->cron(config('newsbox.newstopic.cron.newstopic_schedule'))
                ->appendOutputTo('/tmp/laravel-cron');
        }

        $locationList = config('newsbox.weather.location_list');

        foreach ($locationList as $location) {
            $schedule
                ->command(CheckForWeather::class, [$location])
                ->cron(config('newsbox.newstopic.cron.newstopic_schedule'))
                ->appendOutputTo('/tmp/laravel-cron');
        }
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
