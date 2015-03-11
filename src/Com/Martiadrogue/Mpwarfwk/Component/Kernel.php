<?php
namespace Com\Martiadrogue\Mpwarfwk\Component;

use \Com\Martiadrogue\Mpwarfwk\Component\Connection\Http\Response;
use \Com\Martiadrogue\Mpwarfwk\Component\Connection\Http\Request;

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
