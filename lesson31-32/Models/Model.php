<?php

namespace App\Models;

use App\Interfaces\IModel;
//TODO подключить Db

abstract class Model implements IModel
{
    abstract protected function getTableName(): string;

    //where(name, value)

    public function find(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName WHERE id = {$id}";
        //TODO Вызвать query и передать запрос на выполнение
        return $sql;
    }

    public function all()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName";
        return $sql;
    }
}