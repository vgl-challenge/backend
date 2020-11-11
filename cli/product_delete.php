<?php declare(strict_types=1);

include __DIR__ . '/../src/Storage/Queue.php';

use App\Storage\Queue;

class product_delete
{
    private const OPERATION = 'DeleteProduct';

    public function __construct($argv)
    {
        $this->process($argv);
    }

    private function process($argv) : void
    {

        $queue = new Queue();
        $queue->push(self::OPERATION, $argv[1]);
    }
}

new product_delete($argv);