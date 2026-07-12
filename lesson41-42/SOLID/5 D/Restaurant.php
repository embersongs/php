<?php

class Restaurant implements IFoodProvider
{
    public function getFood()
    {
        $food = "someRestaurantFood";
        return $food;
    }
}