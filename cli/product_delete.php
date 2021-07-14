<?php declare(strict_types=1);

use App\Events\DeleteProduct;
use App\Queue\Dispatcher;
use App\Storage\Reader;
use App\Storage\Writer;

if ($argc !== 2) {

	print 'Wrong number of parameters!';
	exit(1);
}

require __DIR__ . '/../vendor/autoload.php';

[, $id] = $argv;

$id = intval($id);

if ($id === 0) {
	print 'Id must be greater than zero';
	exit(1);
}

$event = new DeleteProduct($id);
$dispatcher = new Dispatcher(new Reader(), new Writer());
$dispatcher->dispatchEvent($event);
