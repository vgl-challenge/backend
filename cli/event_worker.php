<?php declare(strict_types=1);

require 'vendor/autoload.php';

$reader = new \App\Storage\Reader();

$file = __DIR__ . '/../storage/queue/queue.txt';
$last_modify_time = 0;


while (true) {
    sleep(1); // 1 s
    clearstatcache(true, $file);
    $curr_modify_time = filemtime($file);

    if ($last_modify_time < $curr_modify_time) {
        echo file_get_contents($file);
    }

    $last_modify_time = $curr_modify_time;
}
