<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class Email implements Validable
{
    private $tag;
    private $log;

    public function __construct($tag, Logger $log)
    {
        $this->tag = $tag;
        $this->log = $log;
    }

    public function validate($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->log->addMessage($this->tag.' must be valid email.');

            return false;
        }

        return true;
    }
}
