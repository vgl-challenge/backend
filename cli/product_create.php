<?php declare(strict_types=1);
require_once dirname(__DIR__) . "/src/Storage/Writer.php";
require_once dirname(__DIR__) . "/src/Storage/Reader.php";
require_once dirname(__DIR__) . "/src/Product.php";
require_once dirname(__DIR__) . "/src/Eventlistener.php";
use App\Storage\Reader;
use App\Storage\Writer;
use App\Product;
use App\Eventlistener;


//$r = new Writer();

$id = readline('Enter a Prduct Id ');

$name = readline('Enter a Prduct name ');

$price = readline('Enter a Prduct Price ');

$product = new Product();
$product->setId((int)$id);
$product->setName($name);
$product->setPrice((float)$price);
$writer = new Writer();

$writer->create($id,serialize($product));
Eventlistener::queue('Create', function($id,$name,$price){
    echo 'Product created: '. $id .' ' . $name. ' '. $price. '<br>';
});
