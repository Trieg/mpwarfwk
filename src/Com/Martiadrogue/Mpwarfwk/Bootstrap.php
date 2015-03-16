<?php
namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;

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
        $response = new Response();
        $this->mapingRoutes($request);

        return $response;
    }

    private function mapingRoutes(Request $request)
    {
        $router = new Router($request);
        $router->add('/', 'HomeController()');
        $router->add('/about', 'AboutController()');
        $router->add('/test', 'TestController()');
        $router->add('/test/list', 'TestController::list()');
        $router->add('/test/{id}', 'TestController::show()');
        $router->add('/contact', 'ContactController()');
        $router->submit();
    }
}
