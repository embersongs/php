<?php

//формирование header SetCookie чтобы браузер создал куку
setcookie("theme", "dark", time() + 36000, "/");

var_dump($_COOKIE);

