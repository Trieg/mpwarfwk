<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

class RegEx implements Validable
{
    private $regex;
    private $log;

    public function __construct($regex, Logger $log) {
        $this->regex = $regex;
        $this->log = $log;
    }

    public function validate($value)
    {
        if ((bool) preg_match($this->regex, $value)) {
            $this->log->addMessage($value.' must validate against '.$this->regex.'.');

            return true;
        }

        return false;
    }
}
