<?php

declare(strict_types=1);

namespace App\Action;

use App\EventFactory;
use App\Logger;
use App\ProductFactory;
use App\Projection;
use App\Queue;
use InvalidArgumentException;
use Throwable;

class UpdateAction
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
            $this->queue->add($this->eventFactory->updateEvent($product));
        } catch (Throwable $throwable) {
            $this->logger->log($throwable);
        }
    }
}