<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class RegEx implements Validable
{
    private $tag;
    private $regex;
    private $log;

    public function __construct($tag, $regex, Logger $log)
    {
        $this->tag = $tag;
        $this->regex = $regex;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (!(bool) preg_match($this->regex, $value)) {
            $this->log->addMessage($this->tag.' must validate against '.$this->regex.'.');

            return false;
        }

        return true;
    }
}
