<?php

namespace App\Controller;

use App\Middleware\AuthMiddleware;

class ProfileController
{
    public function index(): void
    {
        header('Content-Type: application/json');

        $user = AuthMiddleware::handle();

        echo json_encode([
            'profile' => $user
        ]);
    }
}
