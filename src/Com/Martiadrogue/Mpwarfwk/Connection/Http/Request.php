<?php

namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

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
        $last = strlen($this->server->getItem('REQUEST_URI')) - 1;
        if ($this->server->getItem('REQUEST_URI')[$last] === '/') {
            return $this->server->getItem('REQUEST_URI');
        }

        return $this->server->getItem('REQUEST_URI').'/';
    }
}
