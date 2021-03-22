<?php

declare(strict_types=1);

namespace App;

use App\Event\Event;
use App\Processor\CreateProcessor;
use App\Processor\DeleteProcessor;
use App\Processor\UpdateProcessor;

class EventHandler
{
    public function __construct(
        private Queue $queue,
        private CreateProcessor $createProcessor,
        private UpdateProcessor $updateProcessor,
        private DeleteProcessor $deleteProcessor,
    )
    {
    }

    public function run():void
    {
        foreach ($this->queue->getEvents() as $event) {
            echo match ($event->getType()) {
                Event::CREATED => $this->createProcessor->process($event),
                Event::UPDATED => $this->updateProcessor->process($event),
                Event::DELETED => $this->deleteProcessor->process($event),
                default => 'Invalid event provided'
            };
        }
        $this->queue->empty();
    }
}