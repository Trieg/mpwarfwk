<?php

namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;
use Com\Martiadrogue\Mpwarfwk\Debug\DebugBar;
/**
 *
 */
class BootstrapDev extends Bootstrap
{
    private $debugBar;

    public function __construct()
    {
        Debug::enable();
        $this->debugBar = new DebugBar();
    }

    public function boot(BaseRequest $request)
    {
        parent::boot($request);
        $this->debugBar->regist();
        echo $this->debugBar->render();
    }
}
