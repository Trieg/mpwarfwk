<?php
namespace Com\Martiadrogue\Mpwarfwk\Controller;

use \ReflectionClass;
use \BindingResolutionException;

/**
 *
 */
class ControllerDispatcher
{

    public function dispatch($namespace, $action, Array $parameters)
    {
        $controller = $this->makeController($namespace);
        return $this->call($controller, $action, $parameters);
    }

    private function makeController($namespace)
    {
        $reflector = new ReflectionClass($namespace);
        if (!$reflector->isInstantiable())
        {
            throw new BindingResolutionException("Target [$concrete] is not instantiable.");
        }

        return $reflector->newInstanceArgs(array());
    }

    private function call($controller, $action, Array $parameters)
    {
        return $controller->callAction($action, $parameters);
    }

}
