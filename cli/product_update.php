<?php declare(strict_types=1);
require_once dirname(__DIR__) . "/src/Storage/Reader.php";
require_once dirname(__DIR__) . "/src/Product.php";
require_once dirname(__DIR__) . "/src/Storage/Writer.php";
require_once dirname(__DIR__) . "/src/Eventlistener.php";
use App\Storage\Reader;
use App\Storage\Writer;
use App\Product;
use App\Eventlistener;
$reader = new Reader();

$id = readline('Enter a Prduct Id ');
  if($id != null )  {
      $product = unserialize($reader->read($id));
  }
 if($product instanceof Product) {
   $name = readline('Enter a Prduct name ');
   $price = readline('Enter a Prduct Price ');
   if($name != null )  {
     $product->setName($name);
   }
   if($price != null )  {
     $product->setPrice((float)$price);
   }
 }

$writer = new Writer();
$writer->update($id,serialize($product));

Eventlistener::queue('update', function($name,$price){
    string $str = 'Product updated: ';
    if ($name != null)
    {
      $str+= $name .' ';
    }
    if ($price != null)
    {
      $str+= $price .' ';
    }
    $str+= '<br>';
    echo $str;;
});
