<?php declare(strict_types=1);

namespace App\Storage;

class Queue
{
    private const STORAGE_PATH = __DIR__ . '/../../storage/';
    private const FILENAME = 'queue.txt';

    function push($operation, $values) : void
    {
        if (file_exists(self::STORAGE_PATH . self::FILENAME) === false) {
            touch(self::STORAGE_PATH . self::FILENAME);
        }
        $file = fopen(self::STORAGE_PATH . self::FILENAME, 'a');
        fwrite($file, $operation . ',' . $values . PHP_EOL);
        fclose($file);
    }

    function pop()
    {

        if (file_exists(self::STORAGE_PATH . self::FILENAME) === false) {
            throw new \RuntimeException('File not found at:' . self::STORAGE_PATH . self::FILENAME);
        }

        $file = file(self::STORAGE_PATH . self::FILENAME);
        if (empty($file) === false) {
            $line = $file[0];
            unset($file[0]);
            file_put_contents(self::STORAGE_PATH . self::FILENAME, $file);
            $lineArray = explode(',', $line);
        } else {
            $lineArray = [];
        }

        return $lineArray;
    }
}