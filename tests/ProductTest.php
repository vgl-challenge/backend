<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    /**
     * @var \App\Product $product
     */
    private $product;

    protected function setUp():void
    {
        $this->product = new \App\Product(0);
        $this->product->setName('test');
        $this->product->setPrice('55,55');
        $this->product->save();
    }


    public function testCanGetName(): void
    {
        $this->assertEquals(
            'test',
            $this->product->getName()

        );
    }

    public function testCanLoad(): void
    {
        $newProduct = new \App\Product(0);
        $this->assertEquals(
            'test',
            $newProduct->getName()

        );
    }
}