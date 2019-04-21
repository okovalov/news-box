<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Presearch\Models\AccountTransaction;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewsTopicHasBeenReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * NewsTopic that was created
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

