<?php

namespace Tj\Ghwebhook\Concerns;

use Illuminate\Support\Facades\Log;
use Tj\Ghwebhook\Contracts\LogType;

trait InteractsWithLog
{
    public function log(LogType $type, string $message, array $context = [])
    {

        $channel = config('ghwebhook.logging.channel');

        if ($type == LogType::INFO) {
            Log::channel($channel)->info($message);
        } elseif ($type == LogType::DEBUG) {
            ray($context);
            Log::channel($channel)->debug($message, $context);
        } elseif ($type == LogType::ERROR) {
            Log::channel($channel)->error($message, $context);
        }
    }
}
