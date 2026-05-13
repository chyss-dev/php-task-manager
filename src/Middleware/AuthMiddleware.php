<?php

namespace App\Middleware;

use App\Repository\TokenRepository;

class AuthMiddleware
{
    public static function handle(): array
    {
        $headers = getallheaders();

        $authHeader = $headers['Authorization'] ?? null;

        if (!str_starts_with($authHeader, 'Bearer ')) {
            self::unauthorized();
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $user = (new TokenRepository())->findUserByToken($token);

        if (!$user) {
            self::unauthorized();
        }

        return $user;
    }

    private static function unauthorized(): void
    {
        header('HTTP/1.1 401 Unauthorized');

        echo json_encode(['error' => 'Unauthorized']);

        exit;
    }

}
