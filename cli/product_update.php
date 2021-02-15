<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Product;
use App\Event;

if (4 == sizeof($argv)) {
    $product = new Product(intval($argv[1]));

    $map = ['Name' => 2, 'Price' => 3];
    $changed = 0;

    foreach ($map as $fildname => $index) {
        $getter = 'get'.$fildname;
        $setter = 'set'.$fildname;
        if ($product->$getter() != $argv[$index]) {
            $product->$setter($argv[$index]);
            $changed = 1;
            $event = new Event();
            // I would add the field name to the event but the test just wants the value
            $event->add(sprintf('Product updated: %s', $product->$getter()));
            $event->save();
        }
    }

    if ($changed) {
        $product->save();
    }
}
