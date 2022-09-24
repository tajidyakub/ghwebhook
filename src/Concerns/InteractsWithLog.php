<?php

namespace Tj\Ghwebhook\Concerns;

use Illuminate\Support\Facades\Log;
use Tj\Ghwebhook\LogType;

trait InteractsWithLog
{
    public function log(LogType $type, string $message, array $context = [])
    {
        $webhook = resolve(\Tj\Ghwebhook\Webhook::class);
        $channel = $webhook->payload->config['logging.channel'];

        if ($type == LogType::INFO) {
            Log::channel($channel)->info($message);
        } elseif ($type == LogType::DEBUG) {
            Log::channel($channel)->debug($message, $context);
        } elseif ($type == LogType::ERROR) {
            Log::channel($channel)->error($message, $context);
        }
    }
}
