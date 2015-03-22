<?php
namespace Com\Martiadrogue\Mpwarfwk\Controller;

use Com\Martiadrogue\Mpwarfwk\Service\Database\PdoService;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use BadMethodCallException;

/**
 *
 */
abstract class BaseController
{
    private $response;

    /**
     * MainAction.
     */
    public function index()
    {
        # code...
    }

    /**
     * Execute an action on the controller.
     *
     * @param string $method     [description]
     * @param Array  $parameters [description]
     *
     * @return Com\Martíadrogue\Connection\Http\Response
     */
    public function callAction($method, Array $parameters)
    {
        return call_user_func_array(array($this, $method), $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [$method] does not exist.");
    }
}
