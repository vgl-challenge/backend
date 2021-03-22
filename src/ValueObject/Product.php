<?php

declare(strict_types=1);

namespace App\ValueObject;

class Product
{
    private int $price;
    public function __construct(
        private int $id,
        private string $name,
        float $price,
    )
    {
        $this->price = (int) round($price * 100 ,0);
    }

    public function getId(): int
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
        return round($this->price / 100 ,2);
    }

    public function setPrice(float $price): void
    {
        $this->price = (int) round($price * 100 ,0);
    }
}