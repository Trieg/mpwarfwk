<?php

namespace Com\Martiadrogue\Mpwarfwk\Cache;

class MemoryCache extends BaseCache
{

    private $memcached;


    function __construct()
    {
        parent::__construct();
        $this->memcached = new Memcached();
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
