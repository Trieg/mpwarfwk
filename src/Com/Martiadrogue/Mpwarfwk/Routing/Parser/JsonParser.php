<?php

namespace Com\Martiadrogue\Mpwarfwk\Routing\Parser;

/**
 *
 */
class JsonParser implements Parseable
{
    private $file;
    private $currentAlias;
    private $currentPath;
    private $currentDefaults;

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
