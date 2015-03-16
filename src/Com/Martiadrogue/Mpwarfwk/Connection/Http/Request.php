<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Session;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Parameter;

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
        $this->get = new Parameter($get);
        $this->post = new Parameter($post);
        $this->files = new Parameter($files);
        $this->cookies = new Parameter($cookies);
        $this->server = new Parameter($server);
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
        return $this->server->getItem('REQUEST_URI');
    }
}
