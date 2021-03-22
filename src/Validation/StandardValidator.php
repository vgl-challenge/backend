<?php

declare(strict_types=1);

namespace App\Validation;

class StandardValidator implements ValidatorInterface
{

    public function validateId(mixed $id): int
    {
        if(!ctype_digit($id)) {
            throw new \InvalidArgumentException('Invalid id provided');
        }
        return (int) $id;
    }

    public function validateName(mixed $name): string
    {
        if(!is_string($name)) {
            throw new \InvalidArgumentException('Invalid name provided');
        }
        return $name;
    }

    public function validatePrice(mixed $price): float
    {
        $price = str_replace(',', '.', $price);
        if(!is_numeric($price)) {
            throw new \InvalidArgumentException('Invalid price provided');
        }
        return (float) $price;
    }
}