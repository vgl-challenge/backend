<?php

declare(strict_types=1);

namespace App\Storage;

class Writer
{
    private const STORAGE_PATH = __DIR__ . '/../../storage/';

    public function create(string $key, string $value): void
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === true) {
            throw new \RuntimeException('File with key already exists: ' . $key);
        }

        file_put_contents($fileName, $value);
    }

    public function delete(string $key): void
    {
        unlink($this->createFileName($key));
    }

    public function update(string $key, string $value): void
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === false) {
            throw new \RuntimeException('File with key does not exist: ' . $key);
        }

        file_put_contents($fileName, $value);
    }

    public function createEvent(string $event): void
    {
        $fp = fopen(self::STORAGE_PATH . 'events', 'a'); //opens file in append mode
        fwrite($fp, $event . '\n');
        fclose($fp);
    }

    private function createFileName(string $key): string
    {
        return self::STORAGE_PATH . $key;
    }

    public function clearEvents(): void
    {
        unlink(self::STORAGE_PATH . 'events');
    }
}
