<?php

namespace App\Middleware;

use App\Service\JwtService;

class AuthMiddleware
{
    public static function handle(): ?object
    {
        $headers = getallheaders();

        $authHeader = $headers['Authorization'] ?? null;

        if (!str_starts_with($authHeader, 'Bearer ')) {
            self::unauthorized();
        }

        $token = str_replace('Bearer ', '', $authHeader);

        try {
            $jwtService = new JwtService();

            return $jwtService->validate($token);

        } catch (\Exception $e) {

            self::unauthorized();
        }
    }

    private static function unauthorized(): void
    {
        header('HTTP/1.1 401 Unauthorized');

        echo json_encode(['error' => 'Unauthorized']);

        exit;
    }
}
