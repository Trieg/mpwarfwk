<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class MinLength implements Validable
{
    private $tag;
    private $min;
    private $log;

    public function __construct($tag, $min, Logger $log)
    {
        $this->tag = $tag;
        $this->min = $min;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (strlen($value) < $this->min) {
            $this->log->addMessage($this->tag.' must be greater than '.$this->min.'.');

            return false;
        }

        return true;
    }
}
