<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Schema;

use Com\Martiadrogue\Mpwarfwk\Service\BaseService;

class ServiceSchema implements Schemable
{
    private $currentClass;
    private $currentParameters;

    public function __construct()
    {
        $this->currentClass = '';
        $this->currentParameters = [];
    }
    public function cast(array $data)
    {
        $services = [];
        foreach ($data as $value) {
            $this->readService($value);
            $services[] = new $this->currentClass($this->currentParameters);
        }

        return $services;
    }

    private function readService($service)
    {
        foreach ($service as $key => $value) {
            if ($key === 'class') {
                $this->currentClass = $value;
            } elseif ($key === 'arguments') {
                $this->currentParameters = $value;
            }
        }
    }
}
