<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Session;
/**
 *
 */
class Request
{
    private $session;
    private $cookies;
    private $get;
    private $post;
    private $server;
    private $files;

    private function __construct(Session $session, $get, $post, $files, $cookies, $server)
    {
        $this->session = $session;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookies = $cookies;
        $this->server = $server;
    }

    public static function createFromGlobals()
    {
        $session = new Session();
        $request = new static($session, $_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
        $_GET = $_POST = $_FILES = $_COOKIE = $_SERVER = [];

        return $request;
    }



    public function getUri()
    {
        return $this->server['REQUEST_URI'];
    }
}
