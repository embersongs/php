<?php

class DbLogger implements ILogger
{
    private function saveToDb($value) {
        echo "Логируем в БД {$value}";
    }

    public function log($value) {
        $this->saveToDb($value);
    }

}