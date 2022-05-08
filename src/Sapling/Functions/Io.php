<?php

namespace Sapling\Functions;

class Io
{
    /**
     *  Escape
     *  Shorthand for htmlspecialchars
     * 
     *  @param string $message
     *  @param int $flags
     *  @param string $encoding
     *  @return string
     */
    function esc(string $message, int $flags = ENT_QUOTES, string $encoding = 'UTF-8'): string
    {
        return htmlspecialchars($message, $flags, $encoding);
    }
    /**
     *  Input
     *  For getting input from an external data, checking if key exists and
     *  filters it
     *  
     *  @param int $type
     *  @param string $name
     *  @param int $filter
     */
    function input(int $type, string $name, int $filter = FILTER_DEFAULT): mixed
    {
        $res = "";
        $res = filter_input($type, $name, $filter);
        if ($type === FILTER_NULL_ON_FAILURE) {
            if ($res === FALSE) {
                Debug::debugClass("Undefined property '{$name}'");
            } else if ($res === NULL) {
                Debug::debugClass('Filter failed');
            }
        } else {
            if ($res === NULL) {
                Debug::debugClass("Undefined property '{$name}'");
            } else if ($res === FALSE) {
                Debug::debugClass('Filter failed');
            }
        }
        return $res;
    }
}
