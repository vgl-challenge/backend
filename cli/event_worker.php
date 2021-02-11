<?php declare(strict_types=1);

require_once 'src/Product.php';
require_once 'src/Queue.php';
require_once 'src/Storage/Reader.php';
require_once 'src/Storage/Writer.php';

while ($outputString = App\Queue::getInstance()->next()) {
	echo $outputString . "\n";
}
