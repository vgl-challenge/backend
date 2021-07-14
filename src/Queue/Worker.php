<?php

namespace App\Queue;

use App\Events\CreateProduct;
use App\Events\DeleteProduct;
use App\Events\Event;
use App\Events\UpdateProduct;
use App\Handlers\Handler;
use App\Handlers\PersistProduct;
use App\Handlers\RemoveProduct;
use App\Handlers\UpdateProduct as UpdateProductHandler;
use App\Storage\Reader;
use App\Storage\Writer;

class Worker {

	private $handlers = [
		CreateProduct::class => [
			PersistProduct::class,
		],
		UpdateProduct::class => [
			UpdateProductHandler::class,
		],
		DeleteProduct::class => [
			RemoveProduct::class,
		],
	];

	/**
	 * @var array
	 */
	private $eventFiles;

	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * @var Writer
	 */
	private $writer;

	/**
	 * Worker constructor.
	 *
	 * @param array $eventFiles
	 * @param Reader $reader
	 * @param Writer $writer
	 */
	public function __construct(array $eventFiles, Reader $reader, Writer $writer) {

		$this->eventFiles = $eventFiles;
		$this->reader = $reader;
		$this->writer = $writer;
	}


	public function processQueue() {

		foreach ($this->eventFiles as $file) {

			$job = $this->reader->read($file);
			$this->handleJob(json_decode($job, true));
			$this->writer->delete($file);
		}
	}

	private function handleJob($job) {

		$eventClass = $job['class'];
		$handlerClasses = $this->handlers[$eventClass] ?? false;

		if (!class_exists($eventClass)) {

			throw new \RuntimeException('Event class could not be found: ' . $eventClass);
		}

		if (!$handlerClasses) {

			throw new \RuntimeException('Handlers are missing for the event: ' . $eventClass);
		}

		/** @var Event $event */
		$event = $eventClass::buildFromArray($job['payload']);

		foreach ($handlerClasses as $handlerClass) {

			if (!class_exists($handlerClass)) {

				throw new \RuntimeException('Handler class could not be found: ' . $handlerClass);
			}

			/** @var Handler $handler */
			$handler = $handlerClass::build();
			$handler->handle($event);
		}

	}
}
