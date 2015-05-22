<?php

namespace Com\Martiadrogue\Mpwarfwk\Debug;

use Com\Martiadrogue\Mpwarfwk\Debug\Collector\Collectable;
use Com\Martiadrogue\Mpwarfwk\Debug\Collector\MemoryCollector;
use Com\Martiadrogue\Mpwarfwk\Debug\Collector\PhpInfoCollector;
use Com\Martiadrogue\Mpwarfwk\Debug\Collector\TimeCollector;


class DebugBar
{
    private $collectors;

    public function __construct()
    {
        $this->addCollector(new PhpInfoCollector());
        $this->addCollector(new MemoryCollector());
        $this->addCollector(new TimeCollector());
        $this->regist();
    }

    public function render()
    {
        $output = $this->getOutput();
        $styles = 'style="background-color:#aaa;border-top: 4px solid #777;padding:6px;-webkit-box-shadow: inset 0 20px 10px -20px rgba(0,0,0,0.8);-moz-box-shadow: inset 0 20px 10px -20px rgba(0,0,0,0.8);box-shadow: inset 0 20px 10px -20px rgba(0,0,0,0.8);"';
        return '<div '.$styles.'><p>'.$output.'</p></div>';
    }

    private function addCollector(Collectable $collector)
    {
        if ($this->hasCollector($collector->getName())) {
            throw new \Exception("'{$collector->getName()}' is already a registered collector");
        }

        $this->collectors[$collector->getName()] = $collector;
    }

    /**
     * Checks if a data collector has been added
     *
     * @param string $name
     * @return boolean
     */
    private function hasCollector($name)
    {
        return isset($this->collectors[$name]);
    }

    private function getOutput()
    {
        $output = '';
        foreach ($this->collectors as $key => $value) {
            $output .= $key . ': ' . $value->collect() . '</p><p>';
        }

        return $output;
    }

    public function regist()
    {
        foreach ($this->collectors as $value) {
            $value->regist();
        }

    }
}
