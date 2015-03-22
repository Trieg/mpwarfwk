<?php
namespace Com\Martiadrogue\Mpwarfwk\Service\Template;

/**
 *
 */
interface Templatable
{
    public function setTemplateHome($path);
    public function setCacheHome($path);
    public function loadTemplate($path);
    public function paint(Array $data);
}
