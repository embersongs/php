<?php

namespace App\Core;

use App\Traits\TSingletone;
use PDO;
use PDOStatement;

class Db
{
    use TSingletone;

    private ?PDO $pdo = null;

    private function getPDO(): PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO('sqlite:database.db');
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }

    private function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchOne(string $sql, array $params = []): ?array
    {
        $row = $this->query($sql, $params)->fetch();
        return $row === false ? null : $row;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute(string $sql, array $params = []): bool
    {
        return $this->query($sql, $params)->rowCount() >= 0;
    }

    public function lastInsertId(): string
    {
        return static::getPDO()->lastInsertId();
    }

    public function fetchObject(string $sql, array $params,string $class): object
    {
        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        return $stmt->fetch();
    }
}