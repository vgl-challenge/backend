<?php declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;
use JsonSerializable;

use function sprintf;

final class Product implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var DateTimeImmutable
     */
    private $created;

    /**
     * @var DateTimeImmutable
     */
    private $modified;

    public function __construct(string $name, string $price)
    {
        $this->name = $name;
        $this->price = (float)$price;
        $this->id = $bytes = uniqid('', true);
        $this->created = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): DateTimeImmutable
    {
        if (null === $this->modified) {
            return $this->getCreated();
        }

        return $this->modified;
    }

    public function setModified(DateTimeImmutable $modified): void
    {
        $this->modified = $modified;
    }

    public function jsonSerialize()
    {
        return sprintf(
            '{"id": "%s", "name": "%s", "price": "%s", "created": "%s", "modified": "%s"}',
            $this->getId(),
            $this->getName(),
            $this->getPrice(),
            $this->getCreated()->format('d-m-Y H:i:s'),
            $this->getModified()->format('d-m-Y H:i:s')
        );
    }
}
