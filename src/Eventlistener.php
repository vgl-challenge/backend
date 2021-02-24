<?php

namespace App;

class Eventlistener
{
    public static $eventsArray = array();

    public static function trigger($event, $args = array())
    {
        if(isset(self::$eventsArray[$event]))
        {
            foreach(self::$eventsArray[$event] as $function)
            {
                call_user_func($function, $args);
            }
        }

    }

    public static function queue($event, $callback)
    {
        self::$eventsArray[$event][] = $func;
    }
}
