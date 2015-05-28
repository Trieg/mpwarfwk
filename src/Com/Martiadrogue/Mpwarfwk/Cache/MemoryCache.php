<?php

namespace Com\Martiadrogue\Mpwarfwk\Cache;

use \Memcached;

class MemoryCache extends BaseCache
{

    private $memcached;


    public function __construct()
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public function get($keyName)
    {
        return $this->memcached->get($keyName);
    }

    public function set($keyName, $value, $ttl)
    {
        return $this->memcached->set($keyName, $value, false, $ttl);
    }

    public function delete($keyName)
    {
        return $this->memcached->delete($keyName);
    }
}
