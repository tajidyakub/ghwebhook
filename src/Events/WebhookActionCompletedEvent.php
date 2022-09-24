<?php

namespace Tj\Ghwebhook\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Tj\Ghwebhook\Contracts\WebhookPayload;

class WebhookActionCompletedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public WebhookPayload $payload)
    {
    }

    public function broadcastOn()
    {
        return config('ghwebhook.events.broadcast_channel');
    }
}
