<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

try {
    if (count($argv) < 2) {
        throw new \RuntimeException("Unsufficient params (id is required");
    }

    list(, $id) = $argv;

    $reader = new App\Storage\Reader;
    $writer = new App\Storage\Writer;
    $persistanceManager = new App\Manager\DataPersistanceManager($reader, $writer);
    $queueManager = new App\Manager\QueueManager($reader, $writer);

    $persistanceManager->delete($id);
    $queueManager->appendToQueue("Product deleted: " . $id);

} catch (\RuntimeException $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}
