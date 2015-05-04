<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Schema;

use Com\Martiadrogue\Mpwarfwk\Routing\Route;

class RouteSchema implements Schemable
{
    private $currentAlias;
    private $currentPath;
    private $currentDefaults;
    private $currentParameters;

    public function __construct()
    {
        $this->currentAlias = '';
        $this->currentPath = '';
        $this->currentDefaults = '';
        $this->currentParameters = [];
    }

    public function cast(array $data)
    {
        $package = '';
        $routes = [];
        foreach ($data as $key => $value) {
            if ($key === 'package') {
                $package = $this->readPackage($value);
            } else {
                $this->currentAlias = $key;
                $this->readRoute($value);
                $routes[] = new Route($this->currentAlias, $this->currentPath, $package.$this->currentDefaults, $this->currentParameters);
            }
        }

        return $routes;
    }

    private function readPackage($package)
    {
        return $package['namespace'];
    }

    private function readRoute($route)
    {
        foreach ($route as $key => $value) {
            if ($key === 'path') {
                $this->currentPath = $this->formatPath($value);
            } elseif ($key === 'defaults') {
                $this->currentDefaults = $value;
            }
        }
    }

    private function formatPath($value)
    {
        $last = strlen($value) - 1;
        if ($value[$last] === '/') {
            return $value;
        }

        return $value.'/';
    }
}
