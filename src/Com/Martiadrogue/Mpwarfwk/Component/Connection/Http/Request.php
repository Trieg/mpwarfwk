<?php
namespace Com\Martiadrogue\Mpwarfwk\Component\Connection\Http;

/**
 *
 */
class Request
{
    private $uri;

    function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $_SERVER["REQUEST_URI"] = array();
    }
}
