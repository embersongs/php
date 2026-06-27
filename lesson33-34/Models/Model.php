<?php

namespace App\Models;

use App\Core\Db;
use App\Interfaces\IModel;

abstract class Model implements IModel
{

    abstract static protected function getTableName(): string;

    //where(name, value)

    public static function find(int $id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM $tableName WHERE id = :id";
        //TODO Вызвать query и передать запрос на выполнение
        return Db::getInstance()->fetchObject($sql, ['id' => $id], static::class);
    }

    public static function all()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM $tableName";
        return Db::getInstance()->fetchAll($sql);
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}