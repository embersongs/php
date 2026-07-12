<?php
//мы не можем внести изменения в этот класс
//если захотим логировать в БД

class Logger
{
    private function saveToFile($value) {
        echo "Логируем в файл {$value}";
    }

    public function log($value) {
        $this->saveToFile($value);
    }

}