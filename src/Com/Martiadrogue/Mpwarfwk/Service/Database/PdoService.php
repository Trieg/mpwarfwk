<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database;

use PDO;
use Com\Martiadrogue\Mpwarfwk\Service\BaseService;
use Com\Martiadrogue\Mpwarfwk\Parser\ConnectionParserFactory;
use Com\Martiadrogue\Mpwarfwk\Parser\RouteParserFactory;

/**
 * http://www.devshed.com/c/a/mysql/building-an-orm-in-php/.
 */
class PdoService extends BaseService
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
    public function __construct(array $params)
    {
        $connectionParser = $params[0];
        $parser = $connectionParser::create();
        $config = $parser->parse();

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
     * @param [type] $table  [description]
     * @param [type] $fields [description]
     *
     * @return [type] [description]
     */
    public function read($table, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $table LIMIT 100");

        return $stmt->fetchAll();
    }

    public function readById($table, $id, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $table WHERE ID = $id LIMIT 100");

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
