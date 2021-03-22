<?php declare(strict_types=1);

use App\EventHandler;
use App\Processor\CreateProcessor;
use App\Processor\DeleteProcessor;
use App\Processor\UpdateProcessor;
use App\Projection;
use App\Queue;
use App\Storage\Reader;
use App\Storage\Writer;

require_once __DIR__ .'/../vendor/autoload.php';


$reader = new Reader();
$writer = new Writer();
$queue = new Queue($writer, $reader);
$projection = new Projection($writer, $reader);
$createProcessor = new CreateProcessor($projection);
$updateProcessor = new UpdateProcessor($projection);
$deleteProcessor = new DeleteProcessor($projection);


$eventHandler = new EventHandler(
    $queue,
    $createProcessor,
    $updateProcessor,
    $deleteProcessor
);

$eventHandler->run();