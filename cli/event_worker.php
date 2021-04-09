<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

try {
    $reader = new App\Storage\Reader;
    $writer = new App\Storage\Writer;
    $queueManager = new App\Manager\QueueManager($reader, $writer);

    $queue = $queueManager->readQueue();
    echo $queue . PHP_EOL;
    $queueManager->flushQueue();

} catch (\RuntimeException $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}
