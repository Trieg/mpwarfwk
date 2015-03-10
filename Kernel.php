<?php
namespace martiadrogue\mpwarfrw;

require_once 'Response.php';
require_once 'Request.php';

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
