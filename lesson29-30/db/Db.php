<?php

class Db {
    protected $tablename;
    protected $wheres = [];

    public function table($name) {
        $this->tablename = $name;
        return $this;
    }

    public function first($id): string
    {
        return "SELECT * FROM {$this->tablename} WHERE id = {$id}";
    }

    public function get() {
        $sql = "SELECT * FROM {$this->tablename} ";
        if (!empty($this->wheres)) $sql .= " WHERE ";
        foreach ($this->wheres as $value) {
            $sql .= $value['field'] . " = " . $value['value'];
            if ($value != end($this->wheres)) $sql .= " AND ";
        }
        $this->wheres = [];
        return $sql . "<br>";

    }

    public function where($field, $value): Db
    {
        $this->wheres[] = [
            'field' => $field,
            'value' => $value
        ];

        return $this;
    }

    public function andWhere($field, $value) {

        return $this->where($field, $value);
    }
}

