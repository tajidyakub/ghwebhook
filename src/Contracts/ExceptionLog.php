<?php
namespace Tj\Ghwebhook\Contracts;

use Tj\Ghwebhook\Concerns\InteractsWithArray;
use Tj\Ghwebhook\Concerns\InteractsWithLog;
use Tj\Ghwebhook\LogType;

class ExceptionLog
{
    use InteractsWithArray,
        InteractsWithLog;

    public string $message;

    public array $context = [];

    public function __construct(public \Throwable $exception)
    {
        $this->message = $exception->getMessage();

        $this->context = [
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace()
        ];

        $this->log(LogType::ERROR, $this->message, $this->context);
    }
}
