<?php declare(strict_types=1);

namespace App\Manager;

use App\Storage\Writer;
use App\Storage\Reader;

/**
 * Data persister manager
 */
class DataPersistanceManager
{
    /**
     * Storage\Reader instance
     *
     * @var Reader
     */
    private $reader;

    /**
     * Storage\Writer instance
     *
     * @var Writer
     */
    private $writer;

    /**
     * Data persister manager
     *
     * @param Reader $reader
     * @param Writer $writer
     */
    public function __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /**
     * Create new data
     *
     * @param string $id
     * @param string $name
     * @param string $price
     *
     * @return void
     */
    public function create(string $id, string $name, string $price) : void
    {
        $this->writer->create($id, implode(";", [$id, $name, $price]));
    }

    /**
     * Update existsing data and return diff
     *
     * @param string $id
     * @param string $name
     * @param string $price
     *
     * @return array
     */
    public function update(string $id, string $name, string $price) : array
    {
        $diff = [];
        $data = explode(";", $this->reader->read($id));
        if ($data[1] != $name) {
            $diff[] = $name;
        }

        if ($data[2] != $price) {
            $diff[] = $price;
        }

        $this->writer->update($id, implode(";", [$id, $name, $price]));

        return $diff;
    }

    /**
     * Delete data
     *
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id) : void
    {
        $this->writer->delete($id);
    }
}
