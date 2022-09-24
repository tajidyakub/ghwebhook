<?php

namespace Tj\Ghwebhook;

trait Initializeable
{
    public static function init(array $args = [])
    {
        return new self(...$args);
    }
}
