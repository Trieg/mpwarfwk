<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Template;

use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 *
 */
class TwigService implements Templatable
{
    private $templateHome;
    private $cacheHome;
    private $template;

    public function __construct()
    {
        $this->templateHome = '../view';
        $this->cacheHome = '../cache/template';
    }

    public function setTemplateHome($path)
    {
        $this->templateHome = $path;
    }

    public function setCacheHome($path)
    {
        $this->cacheHome = $path;
    }

    public function loadTemplate($path)
    {
        $this->template = $path;
    }

    public function paint(Array $data)
    {
        $loader = new Twig_Loader_Filesystem($this->templateHome);
        $twig = new Twig_Environment($loader, [
                'cache' => $this->cacheHome,
                'auto_reload' => true,
            ]);
        $template = $twig->loadTemplate($this->template);

        return $template->render($data);
    }
}
