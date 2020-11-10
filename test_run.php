<?php declare(strict_types=1);

// Id: 42, Name: Staubsauger, Price: 100
shell_exec('php cli/product_create.php 42 Staubsauger 100,00');
shell_exec('php cli/product_update.php 42 Staubsauger 150,00');
shell_exec('php cli/product_delete.php 42');

$output = shell_exec('php cli/event_worker.php');

if ($output === "Product created: 42 Staubsauger 100,00\nProduct updated: 150,00\nProduct deleted: 42\n") {
    echo 'It works!' . PHP_EOL;
} else {
    echo 'Something went wrong!' . PHP_EOL;
}
