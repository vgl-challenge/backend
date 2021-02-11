<?php declare(strict_types=1);

namespace App;

class Product {
	public $id;
	public $name;
	public $price;

	function __construct($id, $name, $price) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
	}

	public static function fetch($id) {
		$reader = new Storage\Reader();
		return unserialize($reader->read($id));
	}

	public function create() {
		$writer = new Storage\Writer();
		Queue::getInstance()->add(null, $this);
		$writer->create($this->id, serialize($this));
	}

	public function update() {
		$writer = new Storage\Writer();
		Queue::getInstance()->add(static::fetch($this->id), $this);
		$writer->update($this->id, serialize($this));
	}

	public function delete() {
		$writer = new Storage\Writer();
		Queue::getInstance()->add($this, null);
		$writer->delete($this->id);
	}



}
