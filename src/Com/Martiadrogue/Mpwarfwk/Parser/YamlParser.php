<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Symfony\Component\Yaml\Parser;

/**
 * Parser parses YAML strings to convert then to PHP arrays.
 */
class YamlParser extends Parsator
{
    public function __construct($file)
    {
        $this->file = $file;
    }

    public function parse()
    {
        $input = file_get_contents($this->file);
        $yaml = new Parser();
        $this->data = $yaml->parse($input, false, false);

        return parent::parse();
    }
}
