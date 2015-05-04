<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\ServiceSchema;

class ServiceParserFactory
{
    const PATTERN_SERVICES = '../config/{services.yml,services.json,services.ini}';

    public static function create()
    {
        $schema = new ServiceSchema();
        $parser = new ParserFactory(self::PATTERN_SERVICES, $schema);

        return $parser->create();
    }
}
