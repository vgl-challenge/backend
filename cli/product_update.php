<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\Storage\ProductQueue;
use App\Storage\Reader;
use App\Storage\Writer;

$reader = new Reader();

$requiredFields = ['id'];

$options = getopt("", ["id:", "name:", "price:"]);

if (count($options) > 2) {
    die('You can only change one field at a time!');
}

$missingFields = array_diff($requiredFields, array_keys($options));

if (!empty($missingFields)) {
    die('Please include id and one other field!');
}

$productJson = $reader->read($options['id'] . '.json');
$productDecoded = json_decode($productJson, true);

$id = $options['id'];
array_shift($options);
$changedFields = '';

foreach ($options as $key => $value) {
    $productDecoded[$key] = $value;
    $changedFields .= "$key: $value";
}

$writer = new Writer();
$writer->update($id . '.json', json_encode($productDecoded));

$queue = new ProductQueue();
$queue->addUpdated($changedFields);
