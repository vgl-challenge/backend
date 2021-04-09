<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

try {
    if (count($argv) < 4) {
        throw new \RuntimeException("Unsufficient params (id, name, and price are required");
    }

    list(, $id, $name, $price) = $argv;

    $reader = new App\Storage\Reader;
    $writer = new App\Storage\Writer;
    $persistanceManager = new App\Manager\DataPersistanceManager($reader, $writer);
    $queueManager = new App\Manager\QueueManager($reader, $writer);

    $persistanceManager->create($id, $name, $price);
    $queueManager->appendToQueue("Product created: " . implode(" ", [$id, $name, $price]));

} catch (\RuntimeException $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}
