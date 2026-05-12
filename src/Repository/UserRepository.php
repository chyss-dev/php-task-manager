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

    public function create(
        string $name,
        string $email,
        string $password
    ): bool {
        $stmt = $this->pdo->prepare("
        INSERT INTO users (name, email, password)
        VALUES (:name, :email, :password)
    ");

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT id, name, email, password, created_at
            FROM users
            WHERE email = :email
        ");

        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
