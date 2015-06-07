<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database;

use PDO;
use Com\Martiadrogue\Mpwarfwk\Service\BaseService;

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

    public function select($sql)
    {
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function query($sql)
    {
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute();
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

    public function readByField($table, $field, $value, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $table WHERE $field = $value LIMIT 100");

        return $stmt->fetchAll();
    }

    public function readByUniqueField($table, $field, $value, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $table WHERE $field = $value");

        return $stmt->fetch();
    }

    public function join($tableLeft, $table, $field, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $tableLeft LEFT JOIN $table USING($field)");

        return $stmt->fetchAll();
    }

    public function joinByField($tableLeft, $table, $field, $value, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->pdo->query("SELECT $fields_list FROM $tableLeft LEFT JOIN $table USING($field) WHERE $table.$field = $value");

        return $stmt->fetchAll();
    }

    public function update($table, $field, $value, ...$data)
    {
        $markersList = $this->getSetMarkersList($data);
        $values = $this->getValues($data, $value);
        $stmt = $this->pdo->prepare("UPDATE $table SET $markersList WHERE $field = ?");

        return $stmt->execute($values);
    }

    public function delete($table, $field, ...$values)
    {
        $markersList = $this->getMarkersList($values);
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $field IN ($markersList)");

        return $stmt->execute($values);
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

    private function getSetMarkersList($values)
    {
        $markers = [];
        $lastValue = count($values) - 1;
        for ($i = 0; $i < $lastValue; $i++) {
            $markers[] = $i % 2 === 0 ? $values[$i].' = ' : '?, ';
        }
        $markers[] = '? ';

        return implode('', $markers);
    }

    private function getValues($newValues, $value)
    {
        $values = [];
        for ($i = 1; $i < count($newValues); $i += 2) {
            $values[] = $newValues[$i];
        }
        $values[] = $value;

        return $values;
    }

    private function getMarkersList(array $values)
    {
        $markers = array_map(function ($item) { return '?'; }, $values);

        return implode(',', $markers);
    }
}
