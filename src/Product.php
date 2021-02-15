<?php declare(strict_types=1);

namespace App;

use phpDocumentor\Reflection\Types\Integer;
use App\Storage\Writer;
use App\Storage\Reader;

/**
 * Class Product
 *
 * @package App
 */
class Product
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name = '';

    /**
     * @var string $price
     */
    private $price = 0;

    /**
     * @var bool
     */
    private $isNew = true;

    /**
     * Product constructor.
     *
     * @param Integer $id
     */
    public function __construct(int $id) {
        $this->id = $id;
        $this->load();
    }

    /**
     * Write Product to Storage
     */
    public function save() {
        $writer = new Writer;
        if ($this->isNew) {
            $writer->create(strval($this->getId()), $this->getStorageString());
        } else {
            $writer->update(strval($this->getId()), $this->getStorageString());
        }
    }

    /**
     * Delete Product from Storage
     */
    public function delete() {
        $writer = new Writer;
        $writer->delete(strval($this->getId()));
    }

    /**
     * Returns the string used to store a Product
     *
     * @return string
     */

    public function getStorageString() {
        return sprintf('%d#%s#%s', $this->getId(), $this->getName(), $this->getPrice());
    }

    /**
     * Read the stored sting into the object
     *
     * @param string $data
     */
    public function getReadString(string $data) {
        $values = explode("#", $data);
        $this->setName($values[1]);
        $this->setPrice($values[2]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * Load from Storage
     */
    private function load() {
        $reader = new Reader();
        if ($reader->check(strval($this->getId()))) {
            try {
                $data = $reader->read(strval($this->getId()));
                $this->getReadString($data);
                $this->isNew = false;
            } catch (\RuntimeException $e) {
                # It is a new Product so don't worry
            }
        }
    }

};
