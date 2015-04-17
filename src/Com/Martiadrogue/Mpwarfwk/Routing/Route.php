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
    private $parameters;

    public function __construct($alias, $path, $defaults, $parameters)
    {
        $this->alias = $alias;
        $this->path = $path;
        $this->defaults = $defaults;
        $this->parameters = $parameters;
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
            return 'execute'.substr($this->defaults, $actionDelimiter + 2);
        }

        return 'executeIndex';
    }

    public function getActionParameters()
    {
        return [];
    }
}
