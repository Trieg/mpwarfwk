<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class NotEmpty implements Validable
{
    private $log;

    public function __construct(Logger $log) {
        $this->log = $log;
    }

    public function validate($value)
    {
        $trimmedValue = trim($value);

        if (empty($trimmedValue)) {
            $this->log->addMessage($value.' must not be empty.');

            return true;
        }

        return false;
    }
}
