<?php

class Rectangle
{
    public $width;
    public $height;

    public function setHeight($height)
    {
        $this->height = $height;
    }


    public function setWidth($width)
    {
        $this->width = $width;
    }





}

class Square extends Rectangle
{

    public function setHeight($value)
    {
        $this->width = $value;
        $this->height = $value;
    }

    public function setWidth($value)
    {
        $this->width = $value;
        $this->height = $value;
    }
}

function area(Rectangle $figure) {
    return $figure->width * $figure->height;
}

$rectange = new Rectangle();
$rectange->setHeight(4);
$rectange->setWidth(5);
var_dump(area($rectange));

$square = new Square();
$square->setHeight(5);
var_dump(area($square));
