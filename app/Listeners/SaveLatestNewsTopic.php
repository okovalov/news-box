<?php
namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewsTopicHasBeenReceived;
use App\Services\NewsTopicService;

class SaveLatestNewsTopic implements ShouldQueue
{
    /**
     * ExchangeService
     *
     * @var ExchangeService
     */
    protected $service;

    public function __construct(NewsTopicService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  NewsTopicHasBeenReceived $event
     * @return void
     */
    public function handle(NewsTopicHasBeenReceived $event)
    {
        $payload = $event->payload;

        $this->service->preserveData($payload);
    }
}
