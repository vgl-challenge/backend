<?php

declare(strict_types=1);

namespace App\Processor;

use App\Event\Created;

class CreateProcessor extends AbstractProcessor
{
    public function process(Created $event): string
    {
        $product = $event->getProduct();
        $this->projection->addProduct($product);
        return sprintf('Product created: %d %s %s' . PHP_EOL,
            $product->getId(),
            $product->getName(),
            number_format($product->getPrice(), 2, ',')
        );
    }
}