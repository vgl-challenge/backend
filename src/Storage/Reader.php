<?php declare(strict_types=1);

namespace App\Storage;

use App\Exception\FileMissingException;

class Reader
{
    private const STORAGE_PATH = __DIR__ . '/../../storage/';

    public function read(string $key) : string
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === false) {
            throw new FileMissingException('File with key does not exist: ' . $key);
        }

        $data = file_get_contents($fileName);

        if ($data === false) {
            throw new \RuntimeException('File with key could not be read: ' . $key);
        }

        return $data;
    }

    private function createFileName(string $key) : string
    {
        return self::STORAGE_PATH . $key;
    }
}
