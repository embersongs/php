<?php

class Product
{
    protected $price;
    private $logger;


    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }


    public function setPrice($price) {
        $this->price = $price;
        $this->logger->log($price);
    }



}