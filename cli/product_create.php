<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Product;
use App\Event;

if (4 == sizeof($argv)) {
    $product = new Product(intval($argv[1]));
    $product->setName($argv[2]);
    $product->setPrice($argv[3]);

    $product->save();

    $event = new Event();
    $event->add(sprintf('Product created: %d %s %s', $product->getId(), $product->getName(), $product->getPrice()));
    $event->save();
}
