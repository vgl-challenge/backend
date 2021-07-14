<?php

namespace App\Events;

interface Event {

	public static function buildFromArray(array $data): Event;
	public function toArray(): array;
}
