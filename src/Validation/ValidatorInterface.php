<?php


namespace App\Validation;


interface ValidatorInterface
{
    public function validateId(mixed $id): int;
    public function validateName(mixed $name): string;
    public function validatePrice(mixed $price): float;
}