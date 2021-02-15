<?php declare(strict_types=1);

namespace App;

use App\Storage\Writer;
use App\Storage\Reader;

/**
 * Class Event
 * @package App
 */
class Event
{
    /**
     * @var string
     */
    private $eventFile = "events.log";

    /**
     * @var string
     */
    private $eventLog = '';


    /**
     * @var bool
     */
    private $isNew = true;

    /**
     * Event constructor.
     */
    public function __construct() {
        $this->load();
    }

    public function save() {
        $writer = new Writer;
        if ($this->isNew) {
            $writer->create($this->eventFile, $this->eventLog);
        } else {
            $writer->update($this->eventFile, $this->eventLog);
        }
    }

    /**
     * @return string
     */
    public function getEventLog(): string
    {
        return $this->eventLog;
    }

    /**
     * Add event
     *
     * @param string $message
     */
    public function add(string $message) {
        $this->eventLog .= $message . "\n";
    }

    /**
     * Reset and Save Events when they are done
     */
    public function reset()
    {
        $this->eventLog = '';
        $this->save();
    }

    /**
     * Load from Storage
     */
    private function load() {
        $reader = new Reader();
        if ($reader->check($this->eventFile)) {
            try {
                $this->eventLog = $reader->read($this->eventFile);
                $this->isNew = false;
            } catch (\RuntimeException $e) {
                # It is a new File so don't worry
            }
        }
    }
}