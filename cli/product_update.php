<?php
declare(strict_types=1);

require_once('src/Storage/Writer.php');

use App\Storage\Writer;

$product =  array(
    'id' => $argv[1],
    'name' => $argv[2],
    'price' => $argv[3]
);

$event = array(
    'command' => 'update',
    'id' =>  $argv[1],
    'data' => $product
);

$writer = new Writer();
$writer->createEvent(json_encode($event));
