<?php

namespace App\Operations;

use \App\Storage\Writer;
use \App\Storage\Reader;

class UpdateProduct implements \App\Operations\OperationsInterface
{
    public function executeOperation(string $key, array $values = []) : void
    {
        $reader = new reader();
        $oldProductData = $reader->read($key);

        $diff = array_diff($values, explode(',', $oldProductData));
        $changedValue = array_pop($diff);

        $writer = new Writer();
        $writer->update($key, implode(',', $values));
        $this->printMessage($changedValue);
    }


    private function printMessage(string $value) : void
    {
        print_r('Product Updated:' . $value);
    }
}
