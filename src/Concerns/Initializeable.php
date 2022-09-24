<?php

namespace Tj\Ghwebhook\Concerns;

trait Initializeable
{
    public static function init(array $args = [])
    {
        return new self(...$args);
    }
}
