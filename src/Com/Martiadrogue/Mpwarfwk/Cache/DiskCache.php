<?php

namespace Com\Martiadrogue\Mpwarfwk\Cache;

class DiskCache extends BaseCache
{
    const CACHE_PATH = '../cache/model/';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($keyName)
    {
        if (file_exists(self::CACHE_PATH.$keyName)) {
            return file_get_contents(self::CACHE_PATH.$keyName);
        }

        return false;
    }

    public function set($keyName, $value, $ttl)
    {
        file_put_contents(self::CACHE_PATH.$keyName, $value);
    }

    public function delete($keyName)
    {
        unlink(self::CACHE_PATH.$keyName);
    }
}
