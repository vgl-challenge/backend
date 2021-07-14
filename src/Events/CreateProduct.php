<?php

namespace App\Events;

class CreateProduct implements Event {

	private $id;
	private $name;
	private $price;

	/**
	 * CreateProduct constructor.
	 *
	 * @param int $id
	 * @param string $name
	 * @param float $price
	 */
	public function __construct(int $id, string $name, float $price) {

		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
	}

	public function toArray(): array {

		return [
			'id' => $this->id,
			'name' => $this->name,
			'price' => $this->price,
		];
	}

	public static function buildFromArray(array $data): Event {

		return new static(
			intval($data['id']),
			$data['name'],
			floatval($data['price'])
		);
	}

}
