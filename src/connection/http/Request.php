<?php
namespace martiadrogue\mpwarfrw\connection\http;

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
