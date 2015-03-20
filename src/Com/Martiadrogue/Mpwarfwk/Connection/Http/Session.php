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

    public function getData($key)
    {
        return $_SESSION[$key];
    }
}
