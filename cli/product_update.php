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
$writer->update($params[0], "Name: " . $params[1] . "\nPrice: " . $params[2]);
Queue::addItemToQueue("Product updated: " . $params[1]);
