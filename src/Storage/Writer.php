<?php declare(strict_types=1);

namespace App\Storage;

use App\Storage\Exception\FileDoesntExistException;
use App\Storage\Exception\FileExistsException;

/**
 * Generic file writer
 */
class Writer
{
    private const STORAGE_PATH = __DIR__ . '/../../storage/';

    /**
     * Create new file with provided content
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function create(string $key, string $value) : void
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === true) {
            throw new FileExistsException('File with key already exists: ' . $key);
        }

        file_put_contents($fileName, $value);
    }

    /**
     * Remove file from filesystem
     *
     * @param string $key
     *
     * @return void
     */
    public function delete(string $key) : void
    {
        unlink($this->createFileName($key));
    }

    /**
     * Replace file contents with new content
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function update(string $key, string $value) : void
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === false) {
            throw new FileDoesntExistException('File with key does not exist: ' . $key);
        }

        file_put_contents($fileName, $value);
    }

    /**
     * Generate full path to the file
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
