<?php declare(strict_types=1);
require_once dirname(__DIR__) . "/src/Storage/Reader.php";
require_once dirname(__DIR__) . "/src/Product.php";
require_once dirname(__DIR__) . "/src/Storage/Writer.php";
require_once dirname(__DIR__) . "/src/Eventlistener.php";
use App\Storage\Reader;
use App\Storage\Writer;
use App\Product;
use App\Eventlistener;

$id = readline('Enter a Prduct Id ');
$writer = new Writer();
$writer->delete($id);
Eventlistener::queue('delete', function($id,$name,$price){
    echo 'Product deleted: '. $id . '<br>';
});
