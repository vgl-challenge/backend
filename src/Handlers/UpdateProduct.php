<?php

namespace App\Handlers;

use App\Events\CreateProduct;
use App\Events\Event;
use App\Storage\Reader;
use App\Storage\Writer;

class UpdateProduct implements Handler {

	/**
	 * @var Writer
	 */
	private $writer;

	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * PersistProduct constructor.
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
	public function handle(Event $event) {

		$productData = $event->toArray();

		$existingProduct = $this->reader->read('product-' . $productData['id']);

		// Find diff and report

		$this->writer->update('product-' . $productData['id'], json_encode($productData));
	}

	public static function build(): Handler {

		return new static(new Reader(), new Writer());
	}
}
