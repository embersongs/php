<?php

include "Bird.php";
include "BirdRun.php";


$bird = new Bird();
$duck = new Duck();
$penguin = new Penguin();
$birdRun = new BirdRun($penguin);
$birdRun->run();


