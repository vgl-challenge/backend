<?php declare(strict_types=1);

require(__DIR__.'/../src/Model/QueueWorker.php');

$queueworker = new QueueWorker();

$queueworker->checkQueue();
die();

echo "********************** WAITING FOR EVENTS *******************************\r\n";
while(true){
    try {
        echo implode("\r\n", $queueworker->checkQueueItem());
        echo "\r\n";
        sleep(1);
    }catch(Exception $e){
        echo "ERROR: ".$e->getMessage();
    }
}

die();
