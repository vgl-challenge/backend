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

    $diff = $persistanceManager->update($id, $name, $price);

    if (!empty($diff)) {
        $queueManager->appendToQueue("Product updated: " . implode(" ", $diff));
    }
} catch (\RuntimeException $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}
