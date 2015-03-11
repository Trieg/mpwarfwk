<?php
namespace com\martiadrogue\mpwarfrw\component;
require_once('../vendor/autoload.php');

use com\martiadrogue\mpwarfwk\component\connection\http\Response;
use com\martiadrogue\mpwarfwk\component\connection\http\Request;

/**
 *
 */
class Kernel
{
    private $request;

    public function handle(Request $request)
    {
        $this->request = $request;
        $response = new Response();
        return $response;
    }
}
