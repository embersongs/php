<?php
$x = 5;
if ($x >= 5) {
    $x++;
    if ($x >= 6) {
        $x++;
        if ($x > 6) {
            $x -= 5;
        } elseif ($x == 3) {
            $x -= 1;
        }
        $x += 5;
    } else {
        $x -= 5; //$x = $x - 5;
    }
    $x++; //$x = $x + 1;
}
echo $x;