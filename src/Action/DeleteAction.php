<?php

declare(strict_types=1);

namespace App\Action;

use App\EventFactory;
use App\Logger;
use App\Queue;
use App\Validation\ValidatorInterface;
use Throwable;

class DeleteAction
{
    public function __construct(
        private Logger $logger,
        private Queue $queue,
        private EventFactory $eventFactory,
        private ValidatorInterface $validator,
    )
    {
    }

    public function run(array $arguments): void
    {
        try {
            $id = $this->validator->validateId($arguments[1]);
            $this->queue->add($this->eventFactory->deleteEvent($id));
        } catch (Throwable $throwable) {
            $this->logger->log($throwable);
        }
    }
}