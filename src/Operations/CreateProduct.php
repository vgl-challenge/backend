<?php

namespace App\Operations;


use \App\Storage\Writer;

class CreateProduct implements \App\Operations\OperationsInterface
{
    public function executeOperation(string $key, array $values = [])
    {
        $writer = new Writer();
        $writer->create($key, implode(',', $values));

        $this->printMessage($values);
    }

    private function printMessage(array $values) : void
    {
        print_r('Product created:' . implode(' ', $values));
    }
}
