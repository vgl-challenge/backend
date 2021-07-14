<?php

namespace App\Events;

class DeleteProduct implements Event {

	private $id;

	/**
	 * CreateProduct constructor.
	 *
	 * @param int $id
	 */
	public function __construct(int $id) {

		$this->id = $id;
	}

	public function toArray(): array {

		return [
			'id' => $this->id,
		];
	}

	public static function buildFromArray(array $data): Event {

		return new static(intval($data['id']));
	}

}
