<?php

namespace Com\Martiadrogue\Mpwarfwk\Controller;

use ReflectionClass;
use BindingResolutionException;
use Com\Martiadrogue\Mpwarfwk\Parser\ServiceParserFactory;
use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;

/**
 *
 */
class ControllerDispatcher
{
    private $request;
    private $servicesSource;

    public function __construct(BaseRequest $request, $servicesSource)
    {
        $this->request = $request;
        $this->servicesSource = $servicesSource;
    }

    public static function createWithoutServicesSource(BaseRequest $request)
    {
        $this->request = $request;
        $this->servicesSource = ServiceParserFactory::PATTERN_SERVICES;
    }

    public function dispatch($namespace, $action, Array $parameters)
    {
        $controller = $this->makeController($namespace);
        $controller = $this->injectDependencies($controller);

        return $this->call($controller, $action, $parameters);
    }

    private function makeController($namespace)
    {
        $reflector = new ReflectionClass($namespace);
        if (!$reflector->isInstantiable()) {
            throw new BindingResolutionException("Target [$namespace] is not instantiable.");
        }

        return $reflector->newInstanceArgs(array());
    }

    public function injectDependencies(BaseController $controller)
    {
        $parser = ServiceParserFactory::create($this->servicesSource);
        $services = $parser->parse();
        $services['request'] = $this->request;
        $controller->setServices($services);

        return $controller;
    }

    private function call(BaseController $controller, $action, Array $parameters)
    {
        return $controller->callAction($action, $parameters);
    }
}
