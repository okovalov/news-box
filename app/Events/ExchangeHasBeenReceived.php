<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Presearch\Models\AccountTransaction;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ExchangeHasBeenReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * AccountTransaction that was started
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

