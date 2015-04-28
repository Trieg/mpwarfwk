<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class JsonParser extends Parsator
{
    public function __construct($file)
    {
        $this->file = $file;
    }

    public function parse()
    {
        $input = file_get_contents($this->file);
        $this->data = json_decode($input, true);

        return parent::parse();
    }
}
