<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class MinLength implements Validable
{
    private $min;
    private $log;

    public function __construct($min, Logger $log) {
        $this->min = $min;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (strlen($value) < $this->min) {
            $this->log->addMessage($value.' must be greater than '.$this->min.'.');

            return true;
        }

        return false;
    }
}
