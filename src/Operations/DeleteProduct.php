<?php

namespace App\Operations;

use \App\Storage\Writer;

class DeleteProduct implements \App\Operations\OperationsInterface
{
    public function executeOperation(string $key, array $values = [])
    {
        $writer = new Writer();
        $writer->delete($key);
        $this->printMessage($key);
    }


    private function printMessage(string $key) : void
    {
        print_r('Product deleted:' . $key);
    }
}
