<?php
namespace Com\Martiadrogue\Mpwarfwk\Component;

/**
 *
 */
class Debug
{

    public static function enable()
    {
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);
    }
}
