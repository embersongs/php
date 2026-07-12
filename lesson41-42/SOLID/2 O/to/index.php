<?php

include "ILogger.php";
include "Product.php";
include "Logger.php";
include "DbLogger.php";


$product = new Product(new DbLogger());
$product->setPrice(10);