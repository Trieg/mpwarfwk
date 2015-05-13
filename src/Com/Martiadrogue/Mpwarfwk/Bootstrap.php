<?php

namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;
use Com\Martiadrogue\Mpwarfwk\Routing\Route;
use Com\Martiadrogue\Mpwarfwk\Controller\ControllerDispatcher;

/**
 *
 */
class Bootstrap
{
    public function boot(BaseRequest $request)
    {
        $response = $this->handle($request);
        $response->send();
    }

    private function handle(BaseRequest $request)
    {
        $route = $this->getRoute($request);
        $response = $this->reflectController($request, $route);
        // check response and return it
        return $response;
    }

    private function getRoute(BaseRequest $request)
    {
        $router = new Router($request);

        return $router->submit();
    }

    private function reflectController(BaseRequest $request, Route $route)
    {
        $class = $route->getControllerClass();
        $action = $route->getControllerAction();
        $parameters = $route->getActionParameters();

        $dispatcher = new ControllerDispatcher($request);

        return $dispatcher->dispatch($class, $action, $parameters);
    }
}
