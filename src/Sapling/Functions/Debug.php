<?php

namespace Sapling\Functions;

use Sapling\Config\Debug as ConfigDebug;

class Debug
{
    private static $errors = ConfigDebug::DEVELOPMENT;
    private static $strict = ConfigDebug::STRICT;
    /**
     *  Debug Class
     * 
     *  Displays an error block in the website.
     *  @param string $message The message to display
     */
    public static function debugClass(string $message)
    {
        if (self::$errors) {
            $array = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            array_shift($array);
            $array = array_reverse($array);
            echo '<pre style="padding: 1em;border: 2px solid red;font-size: 1.2em;background-color:#EE9C96">';
            echo '<h1 style="margin: 0.3em; font-size: 1.5em">' . $message . '</h1>';
            echo "<span><strong>Stack Trace</strong></span>";
            for ($i = 0, $len = count($array); $i < $len; ++$i) {
                echo "\n  " . $array[$i]['file'] . ". Line ({$array[$i]['line']}): {$array[$i]['class']}{$array[$i]['type']}{$array[$i]['function']}()";
            }
            echo "</pre>";
            if (self::$strict) {
                die();
            }
        }
    }
    /**
     *  Die
     * 
     *  Used to make sure the application ends, even if strict is off.
     *  Only use for essential errors.
     *  @param string $message The message to show.
     */
    public static function die(string $message)
    {
        die($message
            . " Error reporting is "
            . (ConfigDebug::DEVELOPMENT ? "on" : "off")
            . ", strict is " . (ConfigDebug::STRICT ? "on" : "off"));
    }
}
