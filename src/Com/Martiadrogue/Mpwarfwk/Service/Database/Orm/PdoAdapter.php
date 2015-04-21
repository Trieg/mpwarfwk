<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database\Orm;

use PDO;

class PdoAdapter extends PDO
{
    private $driver;
    private $host;
    private $dbname;
    private $charset;
    private $username;
    private $password;

    public function __construct()
    {
        $config = ['driver' => 'mysql',
                    'host' => 'localhost',
                    'dbname' => 'frameworkdb',
                    'charset' => 'utf8',
                    'username' => 'frameworkdb_root',
                    'password' => '12345',];
        $this->setUpDatabase($config);
        $this->connect();
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function connect()
    {
        $dsn = $this->buildDsn();
        parent::__construct($dsn, $this->username, $this->password);
    }

    private function buildDsn()
    {
        return "$this->driver:host=$this->host;dbname=$this->dbname;charset=$this->charset";
    }

    private function setUpDatabase($config)
    {
        $this->driver = $config['driver'];
        $this->host = $config['host'];
        $this->dbname = $config['dbname'];
        $this->charset = $config['charset'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }
}
