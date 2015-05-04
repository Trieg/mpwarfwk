<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\RouteSchema;

class RouteParserFactory
{
    const PATTERN_ROUTES = '../config/{routing.yml,routing.json,routing.ini}';

    public static function create()
    {
        $schema = new RouteSchema();
        $parser = new ParserFactory(self::PATTERN_ROUTES, $schema);

        return $parser->create();
    }
}
