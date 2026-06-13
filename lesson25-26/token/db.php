<?php

function getDb(): \PDO
{
    static $db = null;

    if (is_null($db)) {
        $db = new PDO("sqlite:database.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->exec("PRAGMA foreign_keys = ON;");
    }

    return $db;
}

function getPosts():array
{
    $db = getDb();
    $stmt = $db->query("SELECT * FROM posts");

    return $stmt->fetchAll();
}