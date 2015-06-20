<?php

namespace Com\Martiadrogue\Mpwarfwk\Routing;

use Com\Martiadrogue\Mpwarfwk\Security\Filters\Sanitizer;

/**
 *
 */
class Route
{
    private $alias;
    private $path;
    private $defaults;
    private $parameters;
    private $servicesSource;

    public function __construct($alias, $path, $defaults, $parameters, $servicesSource)
    {
        $this->alias = $alias;
        $this->path = $path;
        $this->defaults = $defaults;
        $this->setActionParameters($parameters);
        $this->servicesSource = $servicesSource;
    }

    public function fillArgs($uri)
    {
        $uriExploded = explode('/', $uri);
        $pathExploded = explode('/', $this->path);

        for ($i = 0; $i < count($pathExploded); $i++) {
            if ($pathExploded[$i] === ':arg') {
                $this->parameters[] = $uriExploded[$i];
            }
        }
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

    public function setActionParameters($parameters)
    {
        $healthyParams = $this->cleanData($parameters);

        $this->parameters = $healthyParams;
    }

    public function getActionParameters()
    {
        return $this->parameters;
    }

    public function getServicesSource()
    {
        return $this->servicesSource;
    }

    private function cleanData(array $data)
    {
        $sanitizer = new Sanitizer(ENT_NOQUOTES, 'UTF-8');
        for ($i = 0; $i < count($data); $i++) {
            $data[$i] = $sanitizer->sanitize($data[$i]);
        }

        return $data;
    }
}
