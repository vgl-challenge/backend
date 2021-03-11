<?php

declare(strict_types=1);

namespace Cli;

use SplQueue;

class Queue
{
    private static $queue;
    private static $initialized = false;

    private static function initialize()
    {
        if (self::$initialized)
            return;

        self::$queue = new SplQueue();
        self::$initialized = true;
    }

    public static function addItemToQueue(string $value)
    {
        self::initialize();
        self::$queue->enqueue($value);
        echo $value;
    }

    public static function readQueue()
    {
        while (!self::$queue->isEmpty()) {
            $item = self::$queue->dequeue();
            echo $item . "\n";
        }
    }
}
