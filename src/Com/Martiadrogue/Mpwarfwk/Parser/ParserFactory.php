<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\Schemable;

class ParserFactory
{
    private $pattern;
    private $schema;

    public function __construct($pattern, Schemable $schema)
    {
        $this->schema = $schema;
        $this->pattern = $pattern;
    }

    public function create()
    {
        $extensionMap = [
            'json' => 'JsonParser',
            'ini' => 'IniParser',
            'yaml' => 'YamlParser',
            'yml' => 'YamlParser',
        ];
        foreach (glob($this->pattern, GLOB_BRACE) as $filename) {
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($extension, $extensionMap)) {
                continue;
            }

            return $this->getParser($extensionMap[$extension], $filename);
        }

        return;
    }

    public function getParser($class, $filename)
    {
        $namespace = __NAMESPACE__.'\\Format\\'.$class;

        return new $namespace($filename, $this->schema);
    }
}
