<?php

namespace App\Handlers;

use App\Events\Event;

interface Handler {

	public static function build(): Handler;

	public function handle(Event $event);
}
