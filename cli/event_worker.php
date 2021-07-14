<?php declare(strict_types=1);

use App\Queue\Worker;
use App\Storage\Reader;
use App\Storage\Writer;

require __DIR__ . '/../vendor/autoload.php';

$eventFiles = array_map(function ($path) {
	return basename($path);
}, glob(__DIR__ . '/../storage/event-*.log'));

$worker = new Worker($eventFiles, new Reader(), new Writer());
$worker->processQueue();
