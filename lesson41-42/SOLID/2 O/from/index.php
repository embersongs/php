<?php

include "Product.php";
include "Logger.php";

$product = new Product(new Logger());
$product->setPrice(10);