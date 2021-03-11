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
$writer->delete($params[0]);
Queue::addItemToQueue("Product deleted: " . $params[0]);
