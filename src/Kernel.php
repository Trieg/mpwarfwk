<?php
namespace martiadrogue\mpwarfrw;

use martiadrogue\mpwarfrw\connection\http\Response;
use martiadrogue\mpwarfrw\connection\http\Request;

/**
 *
 */
class Kernel
{
    private $request;

    public function handle(Request $request)
    {
        $this->request = $request;
        $response = new Response();
        return $response;
    }
}
