<?php

declare(strict_types=1);

namespace App\Event;

interface Event
{
    public const CREATED = 1;
    public const UPDATED = 2;
    public const DELETED = 3;
    public function getType(): int;
}