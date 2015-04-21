<?php

namespace Com\Martiadrogue\Mpwarfwk\Routing;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Exception\RouteNotFoundException;
use Com\Martiadrogue\Mpwarfwk\Parser\ParserFactory;

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

    public function submit()
    {
        $uri = $this->request->getUri();
        if (!array_key_exists($uri, $this->uriList)) {
            throw new RouteNotFoundException();
        }

        return $this->uriList[$this->request->getUri()];
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
        $parser = ParserFactory::create();
        $routes = $parser->parse();
        $this->uriList = [];
        foreach ($routes as $route) {
            $this->add($route);
        }
    }
}
