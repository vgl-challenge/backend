<?php

declare(strict_types=1);

namespace App;

use App\Event\Created;
use App\Event\Deleted;
use App\Event\Event;
use App\Event\Updated;
use App\ValueObject\Product;

class EventFactory
{
    public function createEvent(Product $product): Event
    {
        return new Created($product);
    }

    public function deleteEvent(int $id): Event
    {
        return new Deleted($id);
    }

    public function updateEvent(Product $product): Event
    {
        return new Updated($product);
    }
}