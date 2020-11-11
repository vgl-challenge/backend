<?php declare(strict_types=1);

include __DIR__ . '/../src/Storage/Queue.php';
include __DIR__ . '/../src/Operations/OperationsInterface.php';
include __DIR__ . '/../src/Operations/CreateProduct.php';
include __DIR__ . '/../src/Operations/UpdateProduct.php';
include __DIR__ . '/../src/Operations/DeleteProduct.php';
include __DIR__ . '/../src/Storage/Writer.php';
include __DIR__ . '/../src/Storage/Reader.php';

use App\Storage\Queue;
use App\Operations\CreateProduct;
use App\Operations\UpdateProduct;
use App\Operations\DeleteProduct;

class event_worker
{
    private $operations = [];

    public function __construct()
    {
        $this->setUp();
        $queue = new Queue();

        $this->workerLoop($queue);
    }

    private function executeOperation(\App\Operations\OperationsInterface $operation, array $values)
    {
        $key = current($values);
        $operation->executeOperation($key, $values);
    }

    private function setUp()
    {
        $this->operations['CreateProduct'] = new CreateProduct();
        $this->operations['UpdateProduct'] = new UpdateProduct();
        $this->operations['DeleteProduct'] = new DeleteProduct();
    }

    private function workerLoop($queue)
    {
        for ($i = 0; $i < 3; $i++) {
            $nextOperation = $queue->pop();

            if (empty($nextOperation) === false) {
                $operation = $this->operations[$nextOperation[0]];
                unset($nextOperation[0]);
                $this->executeOperation($operation, $nextOperation);
            }
        }
    }
}

new event_worker();