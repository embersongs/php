<?php

class Wife implements IFoodProvider
{
public function getFood() {
    $food = "SomeHomefood";
    return $food;
}
}