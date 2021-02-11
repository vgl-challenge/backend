<?php declare(strict_types=1);

require_once 'src/Product.php';
require_once 'src/Queue.php';
require_once 'src/Storage/Reader.php';
require_once 'src/Storage/Writer.php';

$id = $argv[1];
$name = $argv[2];
$price = $argv[3];

$product = App\Product::fetch($id);

$product->name = $name;
$product->price = $price;
$product->update();
