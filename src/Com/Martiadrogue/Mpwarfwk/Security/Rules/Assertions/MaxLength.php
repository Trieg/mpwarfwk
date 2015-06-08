<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class MaxLength implements Validable
{
    private $max;
    private $log;

    public function __construct($max, Logger $log) {
        $this->max = $max;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (strlen($value) > $this->max) {
            $this->log->addMessage($value.' must be lower than '.$this->max.'.');

            return true;
        }

        return false;
    }
}
