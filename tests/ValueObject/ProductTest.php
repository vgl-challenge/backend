<?php

declare(strict_types=1);

namespace App\Tests\ValueObject;

use App\ValueObject\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $product;

    public function setUp(): void
    {
        $this->product = new Product(1, 'Some name', 100);
    }

    public function testCanRetrieveId(): void
    {
        self::assertEquals(1 , $this->product->getId());
    }

    public function testCanRetrieveName(): void
    {
        self::assertEquals('Some name' , $this->product->getName());
    }

    public function testCanRetrievePrice(): void
    {
        self::assertEquals(100, $this->product->getPrice());
    }

    public function testCanChangeName(): void
    {
        $this->product->setName('new name');
        self::assertEquals('new name' , $this->product->getName());
    }

    public function testCanChangePrice(): void
    {
        $this->product->setPrice(150);
        self::assertEquals(150, $this->product->getPrice());
    }
}