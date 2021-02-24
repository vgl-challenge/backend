<?php declare(strict_types=1);
require_once dirname(__DIR__) . "/src/Eventlistener.php";
use App\Eventlistener;

Eventlistener::trigger('Create');
Eventlistener::trigger('Delete');
Eventlistener::trigger('Update');
