<?php

declare(strict_types=1);

namespace App;

use Throwable;

class Logger
{
    public function log(Throwable $throwable): void
    {
        echo 'We logged and error: ' . $throwable->getMessage();
    }
}