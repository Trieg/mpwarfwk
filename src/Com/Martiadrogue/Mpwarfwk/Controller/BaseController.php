<?php
namespace Com\Martiadrogue\Mpwarfwk\Controller;

use Com\Martiadrogue\Mpwarfwk\Service\Database\PdoService;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\Response;
use PDOException;
use ReflectionClass;
use \BadMethodCallException;

/**
 *
 */
abstract class BaseController
{
    private $response;
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

    /**
     * Execute an action on the controller.
     *
     * @param string $method     [description]
     * @param Array $parameters [description]
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
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [$method] does not exist.");
    }

}
