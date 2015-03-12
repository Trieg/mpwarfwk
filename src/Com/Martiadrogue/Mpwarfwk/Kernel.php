<?php
namespace Com\Martiadrogue\Mpwarfwk;

use \Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use \Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;

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
