<?php
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ExchangeHasBeenReceived;
use App\Services\ExchangeService;

class SaveLatestExchange implements ShouldQueue
{
    /**
     * ExchangeService
     *
     * @var ExchangeService
     */
    protected $service;

    public function __construct(ExchangeService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  ExchangeHasBeenReceived  $event
     * @return void
     */
    public function handle(ExchangeHasBeenReceived $event)
    {
        $payload = $event->payload;

        $this->service->preserveRate($payload);
    }
}
