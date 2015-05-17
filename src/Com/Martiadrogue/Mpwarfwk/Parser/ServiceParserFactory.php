<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\ServiceSchema;

class ServiceParserFactory
{
    const PATTERN_SERVICES = '../config/{services.yaml,services.yml,services.json,services.ini}';

    public static function create($servicesSource)
    {
        $schema = new ServiceSchema();
        $parser = new ParserFactory($servicesSource, $schema);

        return $parser->create();
    }
}
