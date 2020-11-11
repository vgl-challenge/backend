<?php declare(strict_types=1);

include __DIR__ . '/../src/Storage/Queue.php';

use App\Storage\Queue;

class product_create
{
    private const OPERATION = 'CreateProduct';

    public function __construct($argv)
    {
        $this->process($argv);
    }

    private function process($argv) : void
    {
        $queue = new Queue();
        $value = $argv[1] . ',' .  $argv[2] . ',' .  $argv[3];
        $queue->push(self::OPERATION, $value);
    }
}

new product_create($argv);