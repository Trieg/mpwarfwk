<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Schema;

class ServiceSchema implements Schemable
{
    private $currentClass;
    private $currentParameters;
    private $services;

    public function __construct()
    {
        $this->currentClass = '';
        $this->currentParameters = [];
    }
    public function cast(array $data)
    {
        $this->services = [];
        foreach ($data as $key => $value) {
            $this->readService($value);
            $this->services[$key] = new $this->currentClass($this->currentParameters);
        }

        return $this->services;
    }

    private function readService($service)
    {
        foreach ($service as $key => $value) {
            if ($key === 'class') {
                $this->currentClass = $value;
            } elseif ($key === 'arguments') {
                $class = $this->getDependency($value);
                $this->currentParameters[] = new $class();
            }
        }
    }

    private function getDependency($value)
    {
        if (array_key_exists($value, $this->services)) {
            return $this->services[$value];
        }

        return $value;
    }
}
