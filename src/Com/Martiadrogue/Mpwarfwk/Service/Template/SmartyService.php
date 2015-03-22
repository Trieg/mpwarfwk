<?php
namespace Com\Martiadrogue\Mpwarfwk\Service\Template;

use Smarty;

/**
 *
 */
class SmartyService implements Templatable
{
    private $templateHome;
    private $cacheHome;
    private $template;

    public function __construct()
    {
        $this->templateHome = '../view';
        $this->cacheHome = '../cache/smarty';
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
        $smarty = new Smarty();
        $smarty->setTemplateDir($this->templateHome);
        $smarty->setCacheDir($this->cacheHome);
        $smarty->assign('data', $data);

        return $smarty->display($this->template);
    }
}
