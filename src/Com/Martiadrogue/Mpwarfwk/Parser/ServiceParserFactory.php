<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class ServiceParserFactory
{
    const PATTERN_SERVICES = '../config/{services.yml,services.json,services.ini}';

    public static function create()
    {
        return ParserFactory::create(PATTERN_SERVICES);
    }
}
