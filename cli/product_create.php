<?php

declare(strict_types=1);

include "src/Storage/Writer.php";
include "cli/event_worker.php";

use App\Storage\Writer;
use Cli\Queue;

$params = array();
for ($i = 1; $i < $argc; $i++) {
    array_push($params, $argv[$i]);
}

$writer = new Writer();
$writer->create($params[0], "Name: " . $params[1] . "\nPrice: " . $params[2]);
Queue::addItemToQueue("Product created: " . $params[0] . " " . $params[1] . "" . $params[2]);
