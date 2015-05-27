<?php

namespace Com\Martiadrogue\Mpwarfwk\Cache;

class DiskCache extends BaseCache
{

    const CACHE_PATH = '/tmp/cachedisk/';

    function __construct()
    {
        parent::__construct();
    }

    public function get($keyName)
    {
        if (file_exists(self::CACHE_PATH)) {
            return file_get_contents(self::CACHE_PATH . $keyName);
        }

        return false;
    }

    public function set($keyName, $value, $ttl)
    {
        file_put_contents(self::CACHE_PATH . $keyName, $value);
    }

    public function delete($keyName)
    {
        unlilk(self::CACHE_PATH . $keyName);
    }
}
