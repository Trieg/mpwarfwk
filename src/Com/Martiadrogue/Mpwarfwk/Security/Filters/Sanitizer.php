<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Filters;

use Com\Martiadrogue\Mpwarfwk\Connection\Responsible;

class Sanitizer
{
    private $level;
    private $charset;

    public function __construct($level, $charset) {
        $this->level = $level;
        $this->charset = $charset ;
    }

    public function sanitize($value)
    {
        $trimmedValue = trim($value);

        return htmlentities($trimmedValue, $this->level, $this->charset);
    }
}
