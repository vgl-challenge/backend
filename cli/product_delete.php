<?php
declare(strict_types=1);

require_once('src/Storage/Writer.php');

use App\Storage\Writer;

$event = array(
    'command' => 'delete',
    'id' => $argv[1]
);

$writer = new Writer();
$writer->createEvent(json_encode($event));
