<?php

namespace Com\Martiadrogue\Mpwarfwk\Debug\Collector;

/**
 *
 */
class TimeCollector implements Collectable
{
    private $timeStart;
    private $timeElapsedSeconds;
    const TAG_NAME = 'time';

    function __construct()
    {
        $this->timeStart = 0;
        $this->timeElapsedSeconds = 0;
    }

    public function regist()
    {
        $this->timeElapsedSeconds = microtime(true) - $this->timeStart;;
        $this->timeStart = microtime(true);
    }

    public function collect()
    {
        return $this->timeElapsedSeconds . ' seconds';
    }

    public function getName()
    {
        return self::TAG_NAME;
    }
}
