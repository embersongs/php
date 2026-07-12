<?php

class Logger implements ILogger
{
    private function saveToFile($value) {
        echo "Логируем в файл {$value}";
    }

    public function log($value) {
        $this->saveToFile($value);
    }

}