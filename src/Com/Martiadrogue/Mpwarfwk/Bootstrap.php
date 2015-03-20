<?php
namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;
use Com\Martiadrogue\Mpwarfwk\Routing\Route;
use ReflectionMethod;

/**
 *
 */
class Bootstrap
{
    public function boot(Request $request)
    {
        $response = $this->handle($request);
        $response->send();
    }

    private function handle(Request $request)
    {
        $route = $this->getRoute($request);
        $response = $this->reflectController($route);
        // check response and return it
        return $response;
    }

    private function getRoute(Request $request)
    {
        $router = new Router($request);

        return $router->submit();
    }

    private function reflectController(Route $route)
    {
        $class = $route->getControllerClass();
        $action = $route->getControllerAction();

        $reflection = new ReflectionMethod($class, $action);

        return $reflection->invoke(new $class());
    }
}
