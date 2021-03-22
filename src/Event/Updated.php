<?php

declare(strict_types=1);

namespace App\Event;

use App\ValueObject\Product;

class Updated implements Event
{
    public function __construct(
        private Product $product,
    )
    {
    }

    public function getType(): int
    {
        return self::UPDATED;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}