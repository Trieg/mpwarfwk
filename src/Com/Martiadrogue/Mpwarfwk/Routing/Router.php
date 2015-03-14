<?php
namespace Com\Martiadrogue\Mpwarfwk\Routing;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Exception\RouteNotFoundException;

/**
 * Llegir la URL i carregar i retornar la classe corresponent.
 */
class Router
{
    private $uriList;
    private $request;

    public function __construct($request)
    {
        $this->uriList = [];
        $this->request = $request;
    }

    /**
     * Add available routes.
     *
     * @param string $uri [description]
     * @param string $defaults [description]
     */
    public function add($uri, $defaults)
    {
        $this->uri[$uri] = $defaults;
    }

    public function submit()
    {
        if (!array_key_exists($request->getUri(), $this->uriList)) {
            throw RouteNotFoundException();
        }

        return $this->uri[$request->getUri()];
    }

}
