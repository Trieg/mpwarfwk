<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

/**
 *
 */
class Request
{
    private $uri;

    private function __construct($uri)
    {
        $this->uri = $uri;
    }

    public static function createFromGlobals()
    {
        $request = new static($_SERVER['REQUEST_URI']);
        $_SERVER["REQUEST_URI"] = [];

        return $request;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }
}
