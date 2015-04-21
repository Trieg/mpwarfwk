<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class IniParser implements Parseable
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
        $this->data = parse_ini_file($this->file, true);

        return parent::parse();
    }
}
