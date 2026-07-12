<?php

interface CanFly
{
    public function fly(): void;
}

class BirdRun
{
    private $bird;

    public function __construct($bird)
    {
        $this->bird = $bird;
    }

    public function run() {
        $flySpeed = $this->bird->fly();
        echo "Скорость " . $flySpeed;
    }


}