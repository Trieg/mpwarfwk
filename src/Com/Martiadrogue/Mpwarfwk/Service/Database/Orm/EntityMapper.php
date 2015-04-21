<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database\Orm;

class EntityMapper extends Mapper
{
    private $tableName;
    private $entety;
    private $data;  // 'name' => 'type'

    public function __construct($name, EntityMapper $entety, array $data)
    {
        $this->tableName = $name;
        $this->entety = $entety;
        $this->data = $data;
        parent::__construct(new PdoAdapter());
    }

    public function create()
    {
        $values = $this->getEntetyValues();

        return parent::create($this->tableName, $values);
    }

    public function read()
    {
        $fields = array_keys($this->data);

        return parent::read($this->tableName, $fields);
    }

    public function readById($table, $id)
    {
        $fields = array_keys($this->data);

        return parent::readById($this->tableName, $id, $fields);
    }

    public function update()
    {
        $values = $this->getEntetyValues();

        return parent::update($this->tableName, $values);
    }

    public function delete(...$ids)
    {
        return parent::delete($this->tableName, $ids);
    }

    private function getEntetyValues()
    {
        $values = [];
        foreach ($this->data as $key => $value) {
            $getter = 'get'.$key;
            $values[] = $this->entety->$getter;
        }

        return $values;
    }

}
