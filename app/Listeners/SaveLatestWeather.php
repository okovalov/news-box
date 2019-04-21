<?php
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\WeatherHasBeenReceived;
use App\Services\WeatherService;

class SaveLatestWeather implements ShouldQueue
{
    /**
     * WeatherService
     *
     * @var WeatherService
     */
    protected $service;

    public function __construct(WeatherService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  WeatherHasBeenReceived $event
     * @return void
     */
    public function handle(WeatherHasBeenReceived $event)
    {
        $payload = $event->payload;

        $this->service->preserveData($payload);
    }
}
