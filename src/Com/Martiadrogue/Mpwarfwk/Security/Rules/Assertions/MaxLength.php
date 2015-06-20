<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class MaxLength implements Validable
{
    private $tag;
    private $max;
    private $log;

    public function __construct($tag, $max, Logger $log)
    {
        $this->tag = $tag;
        $this->max = $max;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (strlen($value) > $this->max) {
            $this->log->addMessage($this->tag.' must be lower than '.$this->max.'.');

            return false;
        }

        return true;
    }
}
