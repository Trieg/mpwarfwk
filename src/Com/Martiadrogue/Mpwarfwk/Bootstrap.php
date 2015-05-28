<?php

namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\HtmlResponse;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;
use Com\Martiadrogue\Mpwarfwk\Routing\Route;
use Com\Martiadrogue\Mpwarfwk\Controller\ControllerDispatcher;
use Com\Martiadrogue\Mpwarfwk\Parser\ServiceParserFactory;
use Com\Martiadrogue\Mpwarfwk\Exception\RouteNotFoundException;
use Com\Martiadrogue\Mpwarfwk\Cache\MemoryCache;

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

    protected function handle(BaseRequest $request)
    {
        try {
            $route = $this->getRoute($request);
            $response = $this->reflectController($request, $route);
        } catch (RouteNotFoundException $ex) {
            return new HtmlResponse('404! Route Not Found.', 404);
        }

        return $response;
    }

    private function getRoute(BaseRequest $request)
    {
        $router = new Router($request);

        return $router->submit();
    }

    private function reflectController(BaseRequest $request, Route $route)
    {
        $response = $this->getCache($route);
        if (!$response) {
            $class = $route->getControllerClass();
            $action = $route->getControllerAction();
            $parameters = $route->getActionParameters();
            $servicesSource = $this->getServicesSource($route);
            $dispatcher = new ControllerDispatcher($request, $servicesSource);

            $response = $dispatcher->dispatch($class, $action, $parameters);
        }

        return $response;
    }

    private function getServicesSource(Route $route)
    {
        if (empty($route->getServicesSource())) {
            return ServiceParserFactory::PATTERN_SERVICES;
        }

        return $route->getServicesSource();
    }

    private function getCache(Route $route)
    {
        $cache = new MemoryCache();
        $hash = md5($route->getPath());

        return unserialize($cache->get($hash));
    }
}
