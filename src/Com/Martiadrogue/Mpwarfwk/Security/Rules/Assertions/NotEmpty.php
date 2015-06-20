<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules\Assertions;

use Com\Martiadrogue\Mpwarfwk\Security\Rules\Logger;

class NotEmpty implements Validable
{
    private $log;
    private $tag;

    public function __construct($tag, Logger $log)
    {
        $this->log = $log;
        $this->tag = $tag;
    }

    public function validate($value)
    {
        $trimmedValue = trim($value);

        if (empty($trimmedValue)) {
            $this->log->addMessage($this->tag.' must not be empty.');

            return false;
        }

        return true;
    }
}
