<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Format;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\Schemable;
use Symfony\Component\Yaml\Parser;

class YamlParser implements Parsable
{
    private $file;
    private $schema;

    public function __construct($file, Schemable $schema)
    {
        $this->file = $file;
        $this->schema = $schema;
    }

    public function parse()
    {
        $input = file_get_contents($this->file);
        $yaml = new Parser();
        $data = $yaml->parse($input, false, false);

        return $this->schema->cast($data);
    }
}
