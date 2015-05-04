<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser\Format;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\Schemable;

class JsonParser implements Parsable
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
        $data = json_decode($input, true);

        return $this->schema->cast($data);
    }
}
