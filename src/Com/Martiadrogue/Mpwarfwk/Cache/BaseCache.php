<?php

namespace Com\Martiadrogue\Mpwarfwk\Cache;

abstract class BaseCache
{
    const CACHE_PATH = '../cache/model/';

    public function __construct()
    {
        if (!file_exists(self::CACHE_PATH)) {
            mkdir(self::CACHE_PATH, 0700);
        }
    }

    public abstract function get($key);

    public abstract function set($key, $value, $ttl);

    public abstract function delete($key);

    /**
     * $parameters = ['controller' => 'name', 'param1' => 'parameters', 'param2' => 'parameters']
     */
    public function getKeyName(Array $parameters)
    {
        ksort($parameters);
        $key = implode('',$parameters);
        return md5($key);
    }
}
