<?php

namespace Com\Martiadrogue\Mpwarfwk;

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
