<?php

namespace Tj\Ghwebhook\Contracts;

use Tj\Ghwebhook\Concerns\InteractsWithLog;
use Tj\Ghwebhook\Initializeable;
use Tj\Ghwebhook\Contracts\LogType;

class ActionLog
{
    use InteractsWithArray,
        InteractsWithLog,
        Initializeable;

    public function __construct(public LogType $type, public string $message, public array $context = [])
    {
        $this->log($type, $message, $context);
    }
}
