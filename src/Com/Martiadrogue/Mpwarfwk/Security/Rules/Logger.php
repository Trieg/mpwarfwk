<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Rules;

class Logger
{
    private $messageSet;

    public function __construct()
    {
        $this->messageSet = [];
    }

    public function addMessage($newMessage)
    {
        $this->messageSet[] = $newMessage;
    }

    public function getLog()
    {
        return $this->messageSet;
    }
}
