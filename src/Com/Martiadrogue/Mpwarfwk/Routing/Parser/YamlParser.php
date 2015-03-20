<?php
namespace Com\Martiadrogue\Mpwarfwk\Routing\Parser;

use Symfony\Component\Yaml\Parser;
use Com\Martiadrogue\Mpwarfwk\Routing\Route;

/**
 * Parser parses YAML strings to convert then to PHP arrays.
 */
class YamlParser implements Parseable
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
        $input = file_get_contents($this->file);
        $yaml = new Parser();

        $routes = [];
        $data = $yaml->parse($input, false, false);
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
        return $package;
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
