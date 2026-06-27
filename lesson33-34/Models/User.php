<?php

namespace App\Models;


class User extends Model
{
    public int $id;
    public string $name;
    public string $email;

    protected static function getTableName(): string
    {
        return 'users';
    }


}