<?php

namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

/**
 *
 */
class Session
{
    public function __construct()
    {
        session_start();
    }

    public function setValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unsetData($key)
    {
        unset($_SESSION[$key]);
    }

    public function getData($key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return;
    }
}
