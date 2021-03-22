<?php

declare(strict_types=1);

namespace App\Processor;

use App\Event\Deleted;

class DeleteProcessor extends AbstractProcessor
{
    public function process(Deleted $event): string
    {
        $this->projection->deleteProduct($event->getProductId());
        return sprintf('Product deleted: %d' . PHP_EOL,
            $event->getProductId(),
        );
    }
}