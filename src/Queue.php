<?php

declare(strict_types=1);

namespace App;

use App\Event\Event;
use App\Storage\Reader;
use App\Storage\Writer;
use RuntimeException;

class Queue
{
    private const KEY = 'queue';

    private array $events;

    private Writer $writer;
    public function __construct(
        Writer $writer,
        Reader $reader,
    )
    {
        $this->writer = $writer;
        try {
            $this->events = unserialize($reader->read(self::KEY), ['allowed_classes' => true]);
        } catch (RuntimeException) {
            $this->events = [];
            $this->writer->create(self::KEY, serialize([]));
        }

    }

    public function add(Event $product): void
    {
        $this->events[] = $product;
        $this->writer->update(self::KEY, serialize($this->events));
    }

    /**
     * @return Event[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function empty(): void
    {
        $this->events=[];
        $this->writer->update(self::KEY, serialize($this->events));
    }
}