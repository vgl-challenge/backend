<?php

declare(strict_types=1);

namespace App\Event;

use App\ValueObject\Product;

class Deleted implements Event
{
    public function __construct(
        private int $id
    )
    {
    }

    public function getType(): int
    {
        return self::DELETED;
    }

    public function getProductId(): int
    {
        return $this->id;
    }
}