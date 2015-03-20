<?php
namespace Com\Martiadrogue\Mpwarfwk\Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Com\Martiadrogue\Mpwarfwk\Service\Database\PdoService;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use PDOException;
use ReflectionClass;

/**
 *
 */
abstract class BaseController
{
    private $rootTemplate = '../view/';

    public function __construct()
    {
        try {
            // $pdo = new PdoService();
            // $pdo->create('article', 'lorem ipsum', 'author', '10/22/2015','lorem ipsum dolor sit amen', ' Vivamus pellentesque ligula justo, sed mollis odio venenatis vel. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque bibendum enim a dui eleifend molestie. Curabitur eu nisi at orci auctor ultrices at nec sapien. Vestibulum aliquam mi arcu, quis suscipit est posuere vitae. Praesent orci metus, tristique eget libero et, fringilla pulvinar lacus. Phasellus non volutpat leo.');
            // $pdo->read('article', 'title', 'author', 'date', 'brief', 'body');
            // $pdo->update('article', '1', 'lorem ipsum', 'author', '10/22/2015','lorem ipsum dolor sit amen', ' Vivamus pellentesque ligula justo, sed mollis odio venenatis vel. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque bibendum enim a dui eleifend molestie. Curabitur eu nisi at orci auctor ultrices at nec sapien. Vestibulum aliquam mi arcu, quis suscipit est posuere vitae. Praesent orci metus, tristique eget libero et, fringilla pulvinar lacus. Phasellus non volutpat leo.');
            // $pdo->delete('article', 1, 4, 7, 8, 9, 23);
        } catch (PDOException $ex) {
            if ($ex->getCode() === '42S02') {
                // create table
            }
            echo $ex->getMessage();
        }
    }

    /**
     * MainAction.
     */
    public function index()
    {
        # code...
    }

    protected function setRootTemplate($path)
    {
        $this->rootTemplate = $path;
    }

    /**
     * La ruta del template a de ser controller/action.html a no ser que la
     * subclass digui el contrari.
     */
    protected function render(Array $data = [])
    {
        $controller = $this->getControllerName();
        $action = $this->getControllerAction();

        $loader = new Twig_Loader_Filesystem($this->rootTemplate);
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate("$controller/$action.html");
        $content = $template->render($data);

        return new Response($content, 200);
    }

    private function getControllerName()
    {
        $className = get_class($this);
        $function = new ReflectionClass($className);
        $shortName = $function->getShortName();
        $controller = str_replace('Controller', '', $shortName);

        return strtolower($controller);
    }

    public function getControllerAction()
    {
        $callers = debug_backtrace();

        return $callers[2]['function'];
    }
}
