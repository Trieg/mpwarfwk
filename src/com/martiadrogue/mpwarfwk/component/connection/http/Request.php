<?php
namespace  com\martiadrogue\mpwarfwk\component\connection\http;

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
