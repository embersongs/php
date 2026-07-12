<?php

class Product
{
    protected $price;
    private $logger;


    public function __construct()
    {
        $this->logger = new Logger();
    }


    public function setPrice($price) {
        $this->price = $price;
        $this->logger->log($price);
    }



}