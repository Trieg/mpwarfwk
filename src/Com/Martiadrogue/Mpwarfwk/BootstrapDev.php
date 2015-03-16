<?php
namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;
use Com\Martiadrogue\Mpwarfwk\Bootstrap;

/**
 *
 */
class BootstrapDev extends Bootstrap
{
    public function __construct()
    {
        Debug::enable();
    }
}
