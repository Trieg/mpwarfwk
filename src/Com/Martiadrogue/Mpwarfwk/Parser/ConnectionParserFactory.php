<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

use Com\Martiadrogue\Mpwarfwk\Parser\Schema\ConnectionSchema;

class ConnectionParserFactory
{
    const PATTERN_CONNECTIONS = '../config/{connection.php,connection.yaml,connection.yml,connection.json,connection.ini}';

    public static function create()
    {
        $schema = new ConnectionSchema();
        $parser = new ParserFactory(self::PATTERN_CONNECTIONS, $schema);

        return $parser->create();
    }
}
