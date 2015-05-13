<?php

namespace Com\Martiadrogue\Mpwarfwk\Routing;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Exception\RouteNotFoundException;
use Com\Martiadrogue\Mpwarfwk\Parser\RouteParserFactory;
use Com\Martiadrogue\Mpwarfwk\Routing\RouteFinder;

/**
 * Llegir la URL i carregar i retornar la classe corresponent.
 */
class Router
{
    private $uriList;
    private $request;

    public function __construct(Request $request)
    {
        $this->mapRoutes();
        $this->request = $request;
    }

    /**
     * comparar la uri amb cada ruta de l'array
     */
    public function submit()
    {
        $uri = $this->request->getUri();

        $matches = array_filter($this->uriList, array(new RouteFinder($uri), 'isUriEqualTo'));

        if (!count($matches)) {
            throw new RouteNotFoundException();
        }
        $route =  array_shift($matches);
        $route->fillArgs($uri);
        return $route;
    }

    /**
     * Add available routes.
     *
     * @param Route $route [description]
     */
    private function add(Route $route)
    {
        $this->uriList[$route->getPath()] = $route;
    }

    private function mapRoutes()
    {
        $parser = RouteParserFactory::create();
        $routes = $parser->parse();
        $this->uriList = [];
        foreach ($routes as $route) {
            $this->add($route);
        }
    }
}
