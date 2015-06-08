<?php

namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;
use Com\Martiadrogue\Mpwarfwk\Security\Filters\Sanitizer;

/**
 *
 */
class Request extends BaseRequest
{
    private $session;
    private $cookies;
    private $get;
    private $post;
    private $server;
    private $files;

    private function __construct(Session $session, array $get, array $post, array $files, array $cookies, array $server)
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

    public function getPost($key)
    {
        $sanitizer = new Sanitizer(ENT_NOQUOTES, 'UTF-8');
        $value = $this->post->getItem($key);

        return $sanitizer->sanitize($value);
    }

    public function getHttpHost()
    {
        return $this->server->getItem('HTTP_HOST');
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getClientAddresses()
    {
        $ipClient = $this->server->getItem('REMOTE_ADDR');
        if (!empty($this->server->getItem('HTTP_CLIENT_IP'))) {
            $ipClient = $this->server->getItem('HTTP_CLIENT_IP');
        } elseif (!empty($this->server->getItem('HTTP_X_FORWARDED_FOR'))) {
            $ipClient = $this->server->getItem('HTTP_X_FORWARDED_FOR');
        }

        return $ipClient;
    }
}
