<?php declare(strict_types=1);

use App\Events\UpdateProduct;
use App\Queue\Dispatcher;
use App\Storage\Reader;
use App\Storage\Writer;

if ($argc !== 4) {

	print 'Wrong number of parameters!';
	exit(1);
}

require __DIR__ . '/../vendor/autoload.php';

[, $id, $name, $price] = $argv;

$id = intval($id);
$price = floatval($price);

if ($id === 0) {
	print 'Id must be greater than zero';
	exit(1);
}

$event = new UpdateProduct($id, $name, $price);
$dispatcher = new Dispatcher(new Reader(), new Writer());
$dispatcher->dispatchEvent($event);
