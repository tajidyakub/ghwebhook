<?php
namespace Tj\Ghwebhook\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class IncomingRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Request $request)
    {
    }

    public function broadcastOn()
    {
        return config('ghwebhook.events.broadcast_channel');
    }
}
