<?php

namespace Com\Martiadrogue\Mpwarfwk\Routing;

class RouteFinder
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function isUriEqualTo(Route $route)
    {
        $routeElements = explode('/', $route->getPath());
        $uriElements = explode('/', $this->uri);

        $check = true;
        for ($i = 0; $i < count($uriElements); $i++) {
            if ($uriElements[$i] === $routeElements[$i]) {
                continue;
            } elseif ($routeElements[$i] === ':arg') {
                continue;
            }
            $check = false;
            break;
        }

        return $check;
    }
}
