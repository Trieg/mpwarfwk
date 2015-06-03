<?php

namespace Com\Martiadrogue\MpwarfwkTest;

use Com\Martiadrogue\Mpwarfwk\Bootstrap;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;

class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function shouldReturnBaseRequest()
    {
        new Bootstrap();
    }
}
