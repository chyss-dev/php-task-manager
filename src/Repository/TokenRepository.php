<?php

namespace App\Repository;

use App\Config\Database;
use PDO;

class TokenRepository
{
    private PDO $pdo;
    public function __construct(
    ) {
        $this->pdo = Database::connect();
    }

    public function create(int $userId, string $token): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO user_tokens (user_id, token) VALUES (:userId, :token)');

        return $stmt->execute([
            'userId' => $userId,
            'token' => $token
        ]);
    }

    public function findUserByToken(string $token): ?array
    {
        $stmt = $this->pdo->prepare('SELECT u.id, u.name, u.email FROM users u JOIN user_tokens t ON u.id = t.user_id
         WHERE t.token = :token ORDER BY t.id DESC LIMIT 1');

        $stmt->execute(['token' => $token]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
