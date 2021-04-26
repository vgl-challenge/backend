<?php
declare(strict_types=1);

require_once('src/Storage/Writer.php');
require_once('src/Storage/Reader.php');

use App\Storage\Reader;
use App\Storage\Writer;

$reader = new Reader();
$writer = new Writer();

try {
    $events = $reader->readEvents();
} catch (Exception $e) {
    throw new \RuntimeException($e->getMessage());
}

$lines = array_filter(explode('\n', $events));
$output = '';
foreach ($lines as $line) {
    $event = json_decode($line);

    switch ($event->command) {
        case 'create':
            try {
                $writer->create($event->id, json_encode($event->data));
                $output .= "Product created: {$event->data->id} {$event->data->name} {$event->data->price}\n";
            } catch (Exception $e) {
                throw new \RuntimeException($e->getMessage());
            }

            break;
        case 'delete':
            try {
                $writer->delete($event->id);
                $output .= "Product deleted: {$event->id}\n";
            } catch (Exception $e) {
                throw new \RuntimeException($e->getMessage());
            }

            break;
        case 'update':
            try {
                $oldData = json_decode($reader->read($event->id));
                $output .= "Product updated:";

                if ($oldData->name != $event->data->name) {
                    $output .= " {$event->data->name}";
                }

                if ($oldData->price != $event->data->price) {
                    $output .= " {$event->data->price}";
                }

                $output .= "\n";
                $writer->update($event->id, json_encode($event->data));
            } catch (Exception $e) {
                throw new \RuntimeException($e->getMessage());
            }

            break;
    }
}

$writer->clearEvents();

echo $output;

