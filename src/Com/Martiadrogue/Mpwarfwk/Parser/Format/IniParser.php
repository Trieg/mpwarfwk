<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Format;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\Schemable;

class IniParser implements Parsable
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
        $data = parse_ini_file($this->file, true);

        return $this->schema->cast($data);
    }
}
