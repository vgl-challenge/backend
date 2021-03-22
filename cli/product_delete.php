<?php declare(strict_types=1);

require_once __DIR__ .'/../vendor/autoload.php';

use App\Action\DeleteAction;
use App\EventFactory;
use App\Logger;
use App\Queue;
use App\Storage\Reader;
use App\Storage\Writer;
use App\Validation\StandardValidator;


$logger = new Logger();
$reader = new Reader();
$writer = new Writer();
$queue = new Queue($writer, $reader);
$validator = new StandardValidator();
$eventFactory = new EventFactory();


$action = new DeleteAction(
    $logger,
    $queue,
    $eventFactory,
    $validator,
);

$action->run($argv);