<?php

declare(strict_types=1);

namespace App\Action;

use App\EventFactory;
use App\Logger;
use App\ProductFactory;
use App\Queue;
use Throwable;

class AddAction
{
    public function __construct(
        private Logger $logger,
        private Queue $queue,
        private ProductFactory $productFactory,
        private EventFactory $eventFactory,
    )
    {
    }

    public function run(array $arguments): void
    {
        try {
            $product = $this->productFactory->createFromArguments($arguments);
            $this->queue->add($this->eventFactory->createEvent($product));
        } catch (Throwable $throwable) {
            $this->logger->log($throwable);
        }
    }
}