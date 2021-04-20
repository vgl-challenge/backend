<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\Exception\FileMissingException;
use App\Storage\ProductQueue;
use App\Storage\Reader;
use App\Storage\Writer;

$writer = new Writer();

$requiredFields = ['id'];

$options = getopt("", ["id:"]);
$missingFields = array_diff($requiredFields, array_keys($options));

if (!empty($missingFields)) {
    die('Please include id field!');
}

$reader = new Reader();

try {
    $reader->read($options['id'] . '.json');
} catch (FileMissingException $ex) {
    die('Product with given id not found!');
}

$writer->delete($options['id']. '.json');

$queue = new ProductQueue();
$queue->addDeleted($options['id']);