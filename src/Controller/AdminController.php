<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;

class AdminController
{
    public function dashboard(): void
    {
        header("Content-Type: application/json");

        $user = AuthMiddleware::handle();

        RoleMiddleware::handle($user, 'admin');

        echo json_encode(['message' => 'Bienvenido al dashboard de administración']);
    }
}
