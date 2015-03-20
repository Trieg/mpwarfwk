<?php
namespace Com\Martiadrogue\Mpwarfwk\Service\Database;

use PDO;

/**
 *
 */
class PdoService extends PDO
{
    private $driver;
    private $host;
    private $dbname;
    private $charset;
    private $username;
    private $password;
    private $pdo;

    /**
     * La clau primaria de totes les taules s'ha de dir 'ID'.
     *
     * http://stackoverflow.com/questions/8992795/set-pdo-to-throw-exceptions-by-default.
     */
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
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create($table, ...$values)
    {
        $markersList = $this->getMarkersList($values);
        $stmt = $this->pdo->prepare("INSERT INTO $table VALUES (NULL, $markersList)");

        return $stmt->execute($values);
    }

    /**
     * http://stackoverflow.com/questions/13545170/pdo-insert-array-using-key-as-column-name.
     *
     * @param [type] $table   [description]
     * @param [type] $columns [description]
     *
     * @return [type] [description]
     */
    public function read($table, ...$columns)
    {
        $column_list = implode(',', $columns);
        $stmt = $this->pdo->query("SELECT $column_list FROM $table LIMIT 100");

        return $stmt->fetchAll();
    }

    public function update($table, ...$values)
    {
        $markersList = $this->getMarkersList($values);
        $stmt = $this->pdo->prepare("REPLACE INTO $table VALUES ($markersList)");

        return $stmt->execute($values);
    }

    public function delete($table, ...$ids)
    {
        $markersList = $this->getMarkersList($ids);
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE ID IN ($markersList)");

        return $stmt->execute($ids);
    }

    private function connect()
    {
        $dsn = $this->buildDsn();

        $this->pdo = new PDO($dsn, $this->username, $this->password);
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

    private function getMarkersList($values)
    {
        $markers = array_map(function ($item) { return '?'; }, $values);

        return implode(',', $markers);
    }
}
