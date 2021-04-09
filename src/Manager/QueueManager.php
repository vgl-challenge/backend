<?php declare(strict_types=1);

namespace App\Manager;

use App\Storage\Reader;
use App\Storage\Writer;
use App\Storage\Exception\FileDoesntExistException;

/**
 * Queue manager
 */
class QueueManager
{
    /**
     * Storage\Reader instance
     *
     * @var Reader
     */
    private $reader;

    /**
     * Storage\Writer instance
     *
     * @var Writer
     */
    private $writer;

    private const QUEUE_FILENAME = 'queue';

    /**
     * Queue Manager
     *
     * @param Reader $reader
     * @param Writer $writer
     */
    public function __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * Read events from queue
     *
     * @return string
     */
    public function readQueue() : string
    {
        try {
            $log = $this->reader->read("queue");
        } catch (FileDoesntExistException $e) {
            $log = "";
        }

        return $log;
    }

    /**
     * Create new event in the queue
     *
     * @param string $queueMessage
     *
     * @return void
     */
    public function appendToQueue(string $queueMessage) : void
    {
        try {
            $log = $this->reader->read("queue");
            $this->writer->update("queue", $log . PHP_EOL . $queueMessage);
        } catch (FileDoesntExistException $e) {
            $this->writer->create("queue", $queueMessage);
        }
    }

    /**
     * Flush the queue
     *
     * @return void
     */
    public function flushQueue() : void
    {
        $this->writer->delete(self::QUEUE_FILENAME);
    }
}
