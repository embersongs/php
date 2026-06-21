<?php


namespace app\facades;


class DB
{
    private static $db = null;

    /**
     * @param $name
     * @return \Db
     */

    public static function table($name) {
        if (is_null(static::$db)) {
            static::$db = new \Db();
        }
        return static::$db->table($name);
    }

}