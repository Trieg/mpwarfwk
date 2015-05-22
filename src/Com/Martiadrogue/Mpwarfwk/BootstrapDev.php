<?php

namespace Com\Martiadrogue\Mpwarfwk;

use Com\Martiadrogue\Mpwarfwk\Connection\BaseRequest;
use Com\Martiadrogue\Mpwarfwk\Debug\DebugBar;
use Com\Martiadrogue\Mpwarfwk\Connection\Http\HtmlResponse;
use Com\Martiadrogue\Mpwarfwk\Connection\Responsible;

/**
 *
 */
class BootstrapDev extends Bootstrap
{
    private $debugBar;

    public function __construct()
    {
        Debug::enable();
        $this->debugBar = new DebugBar();
    }

    public function boot(BaseRequest $request)
    {
        $response = parent::handle($request);
        $response->send();
        $this->attachDebugBar($response);
    }

    private function attachDebugBar(Responsible $response)
    {
        if ($response instanceof HtmlResponse) {
            $this->debugBar->regist();
            echo $this->debugBar->render();
        }
    }
}
