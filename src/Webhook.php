<?php

namespace Tj\Ghwebhook;

use Illuminate\Http\Request;
use Tj\Ghwebhook\Concerns\InteractsWithLog;
use Tj\Ghwebhook\Contracts\ActionLog;
use Tj\Ghwebhook\Contracts\WebhookPayload;

class Webhook
{
    use InteractsWithLog;

    public WebhookPayload $payload;

    public function __construct(Request $request)
    {
        $this->payload = new WebhookPayload($request);
    }

    public function executeActions()
    {
        foreach ($this->payload->actions as $action) {
            $action->execute();
        }

        new ActionLog(LogType::DEBUG, 'Webhook Actions completed', ['actions' => $this->payload->actions]);

        $this->dispatchEvent(\Tj\Ghwebhook\Events\WebhookActionCompletedEvent::class, ['payload' => $this->payload]);
    }

    public function dispatchEvent(string $event, array $args)
    {
        if ($this->payload->config['events.enabled']) {
            $event::dispatch(...$args);
        }
    }

    public function verifySignature(string $req_signature): bool
    {
        $req_body = $this->payload->request->getContent();
        $signature = 'sha256='.hash_hmac('sha256', $req_body, $this->payload->config['secret']);

        return hash_equals($signature, $req_signature);
    }
}
