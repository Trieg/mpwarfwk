<?php

namespace Com\Martiadrogue\Mpwarfwk\Debug\Collector;

/**
 *
 */
class PhpInfoCollector implements Collectable
{
    private $version;
    const TAG_NAME = 'php';

    function __construct()
    {
        $this->version;
    }

    public function regist()
    {
        $this->version = PHP_VERSION;
    }

    public function collect()
    {
        return $this->version;
    }

    public function getName()
    {
        return self::TAG_NAME;
    }
}
