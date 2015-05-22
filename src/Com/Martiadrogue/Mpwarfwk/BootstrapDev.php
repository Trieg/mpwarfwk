<?php

namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;

/**
 *
 */
class BootstrapDev extends Bootstrap
{
    private $timeStart;

    public function __construct()
    {
        Debug::enable();
        $this->start = microtime(true);
    }

    public function boot(BaseRequest $request)
    {
        parent::boot($request);
        $timeElapsedSeconds = microtime(true) - $this->timeStart;
        echo 'Execution time: ' . $timeElapsedSeconds.' seconds';
    }
}
