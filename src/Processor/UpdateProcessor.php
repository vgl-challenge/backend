<?php

declare(strict_types=1);

namespace App\Processor;

use App\Event\Updated;

class UpdateProcessor extends AbstractProcessor
{

    public function process(Updated $event): string
    {
        $product = $event->getProduct();

        return sprintf('Product updated: %s' . PHP_EOL,
            $this->projection->updateProduct($product)
        );
    }
}