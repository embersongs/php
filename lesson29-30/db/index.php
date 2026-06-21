<?php

include "facades/DB.php";
include "Db.php";

use app\facades\DB;

echo DB::table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->get();
echo DB::table('product')->get();
echo DB::table('user')->first(3);

