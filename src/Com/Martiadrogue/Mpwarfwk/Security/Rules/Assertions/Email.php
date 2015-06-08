<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class Email implements Validable
{
    private $log;

    public function __construct(Logger $log) {
        $this->log = $log;
    }

    public function validate($value)
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->log->addMessage($value.' must be valid email.');

            return true;
        }

        return false;
    }
}
