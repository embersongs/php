<?php

namespace App\Traits;

trait TExample
{
    public int $test = 1;

    public function test()
    {
        echo $this->test . PHP_EOL;
    }

}