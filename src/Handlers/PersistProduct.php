<?php

namespace App\Handlers;

use App\Events\CreateProduct;
use App\Events\Event;
use App\Storage\Writer;

class PersistProduct implements Handler {

	/**
	 * @var Writer
	 */
	private $writer;

	/**
	 * PersistProduct constructor.
	 *
	 * @param Writer $writer
	 */
	public function __construct(Writer $writer) {

		$this->writer = $writer;
	}

	/**
	 * @param Event $event
	 */
	public function handle(Event $event) {

		$productData = $event->toArray();

		$this->writer->create('product-' . $productData['id'], json_encode($productData));
	}

	public static function build(): Handler {

		return new static(new Writer());
	}
}
