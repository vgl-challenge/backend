<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\Model\Product;
use App\Storage\Writer;

$writer = new Writer();

$requiredFields = ['name', 'price'];

$options = getopt("", ["name:", "price:"]);
$missingFields = array_diff($requiredFields, array_keys($options));

if (!empty($missingFields)) {
    die('Please include name and price fields!');
}

$product = new Product($options['name'], $options['price']);

$writer->create($product->getId() . '.json', json_encode($product));

