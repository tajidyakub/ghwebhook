<?php

namespace Tj\Ghwebhook\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Tj\Ghwebhook\Contracts\ExceptionLog;
use Tj\Ghwebhook\Events\WebhookErrorEvent;

class WebhookController extends BaseController
{
    public function index(Request $request, \Tj\Ghwebhook\Webhook $webhook)
    {
        // process actions.
        try {
            $webhook->executeActions();
        } catch (\Throwable $e) {
            new ExceptionLog($e);
            $webhook->dispatchEvent(WebhookErrorEvent::class, ['error' => $e]);
        }

        return response()->json([
            'error' => 0,
            'message' => 'OK',
            'data' => [],
        ]);
    }
}
