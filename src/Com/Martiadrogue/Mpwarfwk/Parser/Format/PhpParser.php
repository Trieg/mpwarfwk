<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Format;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\Schemable;

class PhpParser implements Parsable
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
        $data = require_once $this->file;

        return $this->schema->cast($data);
    }
}
