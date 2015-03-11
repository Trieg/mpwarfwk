<?php
namespace martiadrogue\mpwarfrw\connection\http;

/**
 *
 */
class Response
{

    function __construct()
    {
        # code...
    }

    public function send()
    {
        mb_http_output('UTF-8');
        header('Content-Type: text/html; charset=UTF-8');
        // TODO: Enviar la resposta.
    }
}
