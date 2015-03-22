<?php
namespace Com\Martiadrogue\Mpwarfwk\Routing\Parser;

use Com\Martiadrogue\Mpwarfwk\Routing\Route;

/**
 *
 */
class Parsator implements Parseable
{
    protected $file;
    protected $data;
    protected $currentAlias;
    protected $currentPath;
    protected $currentParameters = [];

    public function __construct()
    {
        # code...
    }

    public function parse()
    {
        $package = '';
        $routes = [];
        foreach ($this->data as $key => $value) {
            if ($key === "package") {
                $package = $this->readPackage($value);
            } else {
                $this->currentAlias = $key;
                $this->readRoute($value);
                $routes[] = new Route($this->currentAlias, $this->currentPath, $package.$this->currentDefaults, $this->currentParameters);
                $this->currentParameters = [];
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
            if ($key === "path") {
                $this->currentPath = $this->formatPath($value);
            } elseif ($key === "defaults") {
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
