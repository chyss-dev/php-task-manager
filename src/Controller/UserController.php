<?php

namespace App\Controller;

class UserController
{
    public function index(): void
    {
        header('Content-Type: application/json');

        echo json_encode([
            'message' => 'Listado de usuarios 🚀'
        ]);
    }
}
