<?php
namespace martiadrogue\mpwarfrw;

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
