<?php
namespace Com\Martiadrogue\Mpwarfwk\Routing\Parser;

use Com\Martiadrogue\Mpwarfwk\Routing\Route;

/**
 *
 */
class IniParser implements Parseable
{
    private $file;
    private $currentAlias;
    private $currentPath;
    private $currentDefaults;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function parse()
    {
        $routes = [];
        $data = parse_ini_file($this->file, true);
        $package = '';
        foreach ($data as $key => $value) {
            if ($key === "package") {
                $package = $this->readPackage($value);
            } else {
                $this->currentAlias = $key;
                $this->readRoute($value);
                $routes[] = new Route($this->currentAlias, $this->currentPath, $package.$this->currentDefaults);
            }
        }

        return $routes;
    }

    private function readPackage($package)
    {
        return $package['package'];
    }

    private function readRoute($route)
    {
        foreach ($route as $key => $value) {
            if ($key === "path") {
                $this->currentPath = $value;
            } elseif ($key === "defaults") {
                $this->currentDefaults = $value;
            }
        }
    }
}
