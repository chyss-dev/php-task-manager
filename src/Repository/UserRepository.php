<?php

namespace App\Repository;

use App\Config\Database;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT id, name, email, created_at
            FROM users
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
