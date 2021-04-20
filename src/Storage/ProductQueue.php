<?php declare(strict_types=1);

namespace App\Storage;

class ProductQueue
{
    const FILE_PATH = __DIR__ . '/../../storage/queue/queue.txt';

    public function addCreated($id, $name, $price)
    {
        file_put_contents(self::FILE_PATH,
            sprintf("Product created: {%s} {%s} {%s}\n", $id, $name, $price), FILE_APPEND);
    }

    public function addDeleted(string $id)
    {
        file_put_contents(self::FILE_PATH,
            sprintf("Product deleted: {%s}\n", $id), FILE_APPEND);
    }

    public function addUpdated($changedFields)
    {
        file_put_contents(self::FILE_PATH,
            sprintf("Product updated: {%s}\n", $changedFields), FILE_APPEND);
    }
}
