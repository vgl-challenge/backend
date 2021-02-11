<?php declare(strict_types=1);

namespace App;

class Queue {

	protected static $entries = [];

	protected static $instance = null;

	protected const FILENAME = '_QUEUE';

	private function __construct() {
		// Singleton
	}

	public static function getInstance() {
		if (static::$instance === null) {
			static::$instance = new static();
			try {
				$reader = new Storage\Reader();
				static::$entries = unserialize($reader->read('_QUEUE'));
			} catch (\RuntimeException $runtimeException) {
				$writer = new Storage\Writer();
				$writer->create(static::FILENAME, serialize(static::$entries));
			}
		}
		return static::$instance;
	}

	public function add($oldProduct, $newProduct = null) {
		self::$entries[] = ["old" => $oldProduct, "new" => $newProduct];
		$this->flush();
	}

	public function next() {
		$next = array_shift(static::$entries);
		$this->flush();

		if($next === null) {
			return null;
		} else if($next["old"] !== null && $next["new"] !== null) { //update
			if($next["old"]->name !== $next["new"]->name) {
				return "Product updated: {$next["new"]->name}";
			}
			if($next["old"]->price !== $next["new"]->price) {
				return "Product updated: {$next["new"]->price}";
			}
		} else if($next["old"] !== null) {
			return "Product deleted: " . $next["old"]->id;
		} else {
			return "Product created: {$next['new']->id} {$next['new']->name} {$next['new']->price}";
		}
	}

	protected function flush() {
		$writer = new Storage\Writer();
		$writer->update(static::FILENAME, serialize(static::$entries));
	}


}
