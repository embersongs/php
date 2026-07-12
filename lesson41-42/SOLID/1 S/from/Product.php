<?php

class Product
{
    protected $price;

    public function setPrice($price) {
        $this->price = $price;
        $this->log($price);
    }

    public function log($value) {
        echo "Логируем {$value}";
    }

}