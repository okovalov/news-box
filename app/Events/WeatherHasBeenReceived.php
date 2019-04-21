<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class WeatherHasBeenReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Weather that was created
     *
     * @var array
     */
    public $payload;

    /**
     * Create a new event instance.
     *
     * @param array $payload
     *
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }
}

