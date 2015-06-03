<?php

namespace Com\Martiadrogue\Mpwarfwk\Debug\Collector;

/**
 *
 */
class MemoryCollector implements Collectable
{
    private $memory;
    const TAG_NAME = 'memory';

    public function __construct()
    {
        $this->memory = '';
    }

    public function regist()
    {
        $this->memory = (memory_get_peak_usage(true) / 1024 / 1024).' MiB';
    }

    public function collect()
    {
        return $this->memory;
    }

    public function getName()
    {
        return self::TAG_NAME;
    }
}
