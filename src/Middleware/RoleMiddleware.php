<?php

namespace App\Middleware;

class RoleMiddleware
{
    public static function handle(
        object $user,
        string $role
    ): void {
        if ($user->role !== $role) {
            header('HTTP/1.1 403 Forbidden');

            echo json_encode(['error' => 'Forbidden']);

            exit;
        }
    }
}
