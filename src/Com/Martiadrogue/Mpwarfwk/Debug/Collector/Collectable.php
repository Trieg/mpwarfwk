<?php

namespace Com\Martiadrogue\Mpwarfwk\Debug\Collector;

interface Collectable
{
    public function regist();
    public function collect();
    public function getName();
}
