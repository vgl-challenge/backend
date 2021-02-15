<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Event;

$event = new Event();

print $event->getEventLog(); // Do something with the log

$event->reset();