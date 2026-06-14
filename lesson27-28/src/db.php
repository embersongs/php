<?php
namespace CompanyName\Blog;

use PDO;

function getDb(): PDO
{
    static $db = null;

    if (is_null($db)) {
        $db = new PDO("sqlite:". DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return $db;
}