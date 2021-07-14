<?php

namespace App\Queue;

use App\Events\Event;
use App\Storage\Reader;
use App\Storage\Writer;

class Dispatcher {

	/**
	 * @var Writer
	 */
	private $writer;

	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * Dispatcher constructor.
	 *
	 * @param Reader $reader
	 * @param Writer $writer
	 */
	public function __construct(Reader $reader, Writer $writer) {

		$this->reader = $reader;
		$this->writer = $writer;
	}

	/**
	 * @param Event $event
	 */
	public function dispatchEvent(Event $event) {

		$nextQueueId = $this->getNextId();

		$this->writer->create("event-{$nextQueueId}.log", json_encode([
			'class' => get_class($event),
			'payload' => $event->toArray(),
		]));
	}

	private function getNextId(): int {

		try {
			$id = $this->reader->read('queue-id.log');
			$id += 1;
			$this->writer->update('queue-id.log', $id);

			return $id;
		} catch (\RuntimeException $exception) {

			$this->writer->create('queue-id.log', 1);
			return 1;
		}
	}

}
