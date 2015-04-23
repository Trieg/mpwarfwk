<?php

namespace Com\Martiadrogue\Mpwarfwk\Parser;

/**
 *
 */
class ParserFactory
{
    public static function create($pattern)
    {
        $extensionMap = [
            'json' => 'JsonParser',
            'ini' => 'IniParser',
            'yml' => 'YamlParser',
        ];
        foreach (glob($pattern, GLOB_BRACE) as $filename) {
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
