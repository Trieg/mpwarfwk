<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database\Orm;

interface Mappable
{
    public function create($table, ...$values);

    public function read($table, ...$fields);

    public function readById($table, $id, ...$fields);

    public function update($table, ...$values);

    public function delete($table, ...$ids);
}
