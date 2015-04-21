<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database\Orm;

use PDO;

/**
 * http://www.devshed.com/c/a/mysql/building-an-orm-in-php/.
 */
abstract class Mapper implements Mappable
{
    private $adapter;

    /**
     * La clau primaria de totes les taules s'ha de dir 'ID'.
     *
     * http://stackoverflow.com/questions/8992795/set-pdo-to-throw-exceptions-by-default.
     */
    public function __construct(PDO $adapter)
    {
        $this->adapter = $adapter;
        $this->entity = $entity;
    }

    public function create($table, ...$values)
    {
        $markersList = $this->getMarkersList($values);
        $stmt = $this->adapter->prepare("INSERT INTO $table VALUES (NULL, $markersList)");

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
        $stmt = $this->adapter->query("SELECT $fields_list FROM $table LIMIT 40");

        return $stmt->fetchAll();
    }

    public function readById($table, $id, ...$fields)
    {
        $fields_list = implode(',', $fields);
        $stmt = $this->adapter->query("SELECT $fields_list FROM $table WHERE ID = $id LIMIT 40");

        return $stmt->fetchAll();
    }

    public function update($table, ...$values)
    {
        $markersList = $this->getMarkersList($values);
        $stmt = $this->adapter->prepare("REPLACE INTO $table VALUES ($markersList)");

        return $stmt->execute($values);
    }

    public function delete($table, ...$ids)
    {
        $markersList = $this->getMarkersList($ids);
        $stmt = $this->adapter->prepare("DELETE FROM $table WHERE ID IN ($markersList)");

        return $stmt->execute($ids);
    }

    private function getMarkersList($values)
    {
        $markers = array_map(function ($item) { return '?'; }, $values);

        return implode(',', $markers);
    }

    abstract public function createEntity(array $data);
}
