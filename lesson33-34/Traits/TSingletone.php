<?php

namespace App\Traits;

trait TSingletone
{
    //паттерн синглтон
    private static $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

}