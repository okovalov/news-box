<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\SaveLatestExchange;
use App\Listeners\SaveLatestNewsTopic;
use App\Listeners\SaveLatestWeather;
use App\Events\ExchangeHasBeenReceived;
use App\Events\NewsTopicHasBeenReceived;
use App\Events\WeatherHasBeenReceived;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ExchangeHasBeenReceived::class => [
            SaveLatestExchange::class,
        ],
        NewsTopicHasBeenReceived::class => [
            SaveLatestNewsTopic::class,
        ],
        WeatherHasBeenReceived::class => [
            SaveLatestWeather::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
