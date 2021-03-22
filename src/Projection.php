<?php

declare(strict_types=1);

namespace App;

use App\Exception\ProductNotFoundException;
use App\Storage\Reader;
use App\Storage\Writer;
use App\ValueObject\Product;
use RuntimeException;

class Projection
{
    private const KEY = 'projection';
    private array $products;
    public function __construct(
        private Writer $writer,
        Reader $reader,
    )
    {
        try {
            $this->products = unserialize($reader->read(self::KEY), ['allowed_classes' => true]);
        } catch (RuntimeException) {
            $this->products = [];
            $this->writer->create(self::KEY, serialize([]));
        }
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
        $this->writer->update(self::KEY, serialize($this->products));
    }

    /**
     * @param Product $product
     * @return string
     * @throws ProductNotFoundException
     */
    public function updateProduct(Product $product): string
    {
        foreach ($this->products as $index => $oldProduct) {
            if($product->getId() === $oldProduct->getId()) {
                $this->products[$index] = $product;
                $this->writer->update(self::KEY, serialize($this->products));
                if($product->getName() !== $oldProduct->getName()) {
                    return $product->getName();
                }
                if($product->getPrice() !== $oldProduct->getPrice()) {
                    return number_format($product->getPrice(), 2, ',');
                }
            }
        }
        throw new ProductNotFoundException('Could not find product with id: '. $product->getId());
    }

    /**
     * @param int $productId
     * @throws ProductNotFoundException
     */
    public function deleteProduct(int $productId): void
    {
        $index = null;
        foreach ($this->products as $key => $oldProduct) {
            if ($productId === $oldProduct->getId()) {
                $index = $key;
            }
        }
        if($index === null) {
            throw new ProductNotFoundException('Could not find product with id: '. $productId);
        }
        unset($this->products[$index]);
        $this->writer->update(self::KEY, serialize($this->products));
    }


}