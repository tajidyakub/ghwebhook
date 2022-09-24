<?php

namespace Tj\Ghwebhook\Contracts;

use Illuminate\Http\Request;

interface ActionHandlerInterface
{
    /**
     * Handles action execution after receiving the request.
     */
    public function handle(): mixed;
}
