<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Event;
use App\Product;

if (2 == sizeof($argv)) {
    $product = new Product(intval($argv[1]));
    $product->delete();

    $event = new Event();
    $event->add(sprintf('Product deleted: %d', $product->getId()));
    $event->save();
}


