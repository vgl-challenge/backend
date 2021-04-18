<?php declare(strict_types=1);

require(__DIR__.'/../src/Model/Product.php');

if(count($argv) < 2){
    die('missing_arguments');
}

$product = new Product();
$product->updateFromPayload($argv);


