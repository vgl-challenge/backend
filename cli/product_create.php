<?php declare(strict_types=1);

require(__DIR__.'/../src/Model/Product.php');

if(count($argv) < 4){
    die('missing_arguments');
}

$product = new Product();
$product->createFromPayload($argv);


