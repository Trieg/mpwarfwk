<?php
namespace Com\Martiadrogue\Mpwarfwk\Routing;

/**
 *
 */
class Route
{
    private $alias;
    private $path;
    private $defaults;

    public function __construct($alias, $path, $defaults)
    {
        $this->alias = $alias;
        $this->path = $path;
        $this->defaults = $defaults;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getControllerClass()
    {
        $actionDelimiter = strpos($this->defaults, '::');
        if ($actionDelimiter) {
            return substr($this->defaults, 0, $actionDelimiter);
        }

        return $this->defaults;
    }

    public function getControllerAction()
    {
        $actionDelimiter = strpos($this->defaults, '::');
        if ($actionDelimiter) {
            return substr($this->defaults, $actionDelimiter + 2);
        }

        return 'index';
    }
}
