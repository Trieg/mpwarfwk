<?php
require_once '../vendor/autoload.php';

use \Memcached;

$cache = new Memcached();

$cache->addServer('192.168.33.31', 11211);

$key = __FILE__;

$expirationInSeconds = 300;
$value = $cache->get($key);

if (null === $cache->get($key));
if (null === $value) {
    $value = 'CALCULATE THE COSTLY OPERATION HERE';
    $cache->set($key, $value, $expirationInSeconds);
}
