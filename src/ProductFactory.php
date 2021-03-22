<?php

declare(strict_types=1);

namespace App;

use App\Validation\ValidatorInterface;
use App\ValueObject\Product;
use InvalidArgumentException;

class ProductFactory
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
    }
    public function createFromArguments(array $arguments): Product
    {
        if(count($arguments) !== 4) {
            throw new InvalidArgumentException('Invalid number of arguments provided');
        }

        return new Product(
            $this->validator->validateId($arguments[1]),
            $this->validator->validateName($arguments[2]),
            $this->validator->validatePrice($arguments[3]),
        );
    }
}