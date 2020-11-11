<?php

namespace App\Operations;

interface OperationsInterface
{
    public function executeOperation(string $key, array $values = []);
}