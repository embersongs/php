<?php

namespace App\Models;

use App\Core\Db;
use App\Interfaces\IModel;

abstract class Model implements IModel
{
    public function __set($name, $value)
    {
        //TODO разрешать менять только те поля что есть в fillable
        if (array_key_exists($name, $this->fillable)) {
            $this->fillable[$name] = true;
            $this->$name = $value;
        } else {
            throw new \InvalidArgumentException("Property '{$name}' is not fillable");
        }

    }

    public function __get($name)
    {
        //TODO Разрешать читать только те поля, которые есть в fillable и id
        if ($name === 'id' || array_key_exists($name, $this->fillable)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property '{$name}' is not readable");
    }

    abstract static protected function getTableName(): string;

    //where(name, value)

    public static function find(int $id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM $tableName WHERE id = :id";
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
        $params = [];
        $columns = [];
        $tableName = static::getTableName();

        foreach ($this->fillable as $key => $value) {
            $params[":{$key}"] = $this->$key;
            $columns[] = $key;
        }
        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        //insert откуда взять данные
        $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

        $result = Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $result;
    }

    public function update()
    {
        $params = [];
        $columns = [];
        $tableName = static::getTableName();

        foreach ($this->fillable as $key => $value) {
            if (!$value) {
                continue;
            }
            $params[":{$key}"] = $this->$key;
            $columns[] = "$key = :$key";
        }
        $columns = implode(', ', $columns);

        $sql = "UPDATE $tableName SET $columns WHERE id = :id";
        $params['id'] = $this->id;
        return Db::getInstance()->execute($sql, $params);
    }

    public function destroy(): bool
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        //TODO вызовите или insert или update
    }
}