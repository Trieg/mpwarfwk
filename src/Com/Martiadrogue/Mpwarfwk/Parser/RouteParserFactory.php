<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class RouteParserFactory
{
    const PATTERN_ROUTES = '../config/{routing.yml,routing.json,routing.ini}';

    public static function create()
    {
        return ParserFactory::create(PATTERN_ROUTES);
    }
}
