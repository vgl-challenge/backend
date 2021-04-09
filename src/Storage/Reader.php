<?php declare(strict_types=1);

namespace App\Storage;

use App\Storage\Exception\FileDoesntExistException;

/**
 * Generic file reader
 */
class Reader
{
    private const STORAGE_PATH = __DIR__ . '/../../storage/';

    /**
     * Read file from filesystem
     *
     * @param string $key Basically filename
     *
     * @return string
     */
    public function read(string $key) : string
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === false) {
            throw new FileDoesntExistException('File with key does not exist: ' . $key);
        }

        $data = file_get_contents($fileName);

        if ($data === false) {
            throw new \RuntimeException('File with key could not be read: ' . $key);
        }

        return $data;
    }

    /**
     * Generate full path to requested filename
     *
     * @param string $key
     *
     * @return string
     */
    private function createFileName(string $key) : string
    {
        return self::STORAGE_PATH . $key;
    }
}
