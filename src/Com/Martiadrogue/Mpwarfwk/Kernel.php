<?php
namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Request;
use Com\Martiadrogue\Mpwarfwk\Routing\Router;

/**
 *
 */
class Kernel
{
    public function __construct()
    {
        Debug::enable();
    }

    public function boot()
    {
        $request = Request::createFromGlobals();
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
