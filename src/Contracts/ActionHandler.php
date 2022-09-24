<?php
namespace Tj\Ghwebhook\Contracts;

use Tj\Ghwebhook\LogType;

abstract class ActionHandler
{
    public array $actionLogs = [];

    public function executes(): bool
    {
        if (!$this->handle()) {
            new ActionLog(LogType::DEBUG, "Error while executing {$this::class}.", ['logs' => $this->actionLogs]);

            return false;
        }
        new ActionLog(LogType::INFO, $this::class . ' completed');
        return true;
    }

    abstract public function handle(): mixed;
}
