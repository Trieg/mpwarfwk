<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class RouteParserFactory
{
    const PATTERN = '../config/{routing.yml,routing.json,routing.ini}';

    public static function create()
    {
        $extensionMap = [
            'json' => 'JsonParser',
            'ini' => 'IniParser',
            'yml' => 'YamlParser'
        ];
        foreach (glob(self::PATTERN, GLOB_BRACE) as $filename) {
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($extension, $extensionMap)) {
                continue;
            }
            $class = __NAMESPACE__."\\{$extensionMap[$extension]}";

            return new $class($filename);
        }

        return;
    }
}
