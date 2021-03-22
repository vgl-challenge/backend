<?php

declare(strict_types=1);

namespace App\Processor;

use App\Projection;

abstract class AbstractProcessor
{
    public function __construct(
        protected Projection $projection
    )
    {
    }
}