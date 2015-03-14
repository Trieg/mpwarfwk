<?php
namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Debug;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;

/**
 *
 */
class Kernel
{
    public function __construct() {
        Debug::enable();
    }

    public function boot()
    {
        $request = Request::createFromGlobals();
        $response = $this->handle($request);
        $response->send();
    }

    private function handle(Request $request)
    {
        $response = new Response();
        return $response;
    }
}
