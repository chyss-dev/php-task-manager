<?php

namespace App\Controller;

use App\Service\UserService;

class UserController
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function index(): void
    {
        header('Content-Type: application/json');

        try {
            echo json_encode(
                $this->userService->getUsers()
            );
        } catch (\Exception $e) {

            http_response_code(400);

            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(): void
    {
        header('Content-Type: application/json');

        try {

            $data = json_decode(
                file_get_contents('php://input'),
                true
            );

            $this->userService->createUser($data);

            http_response_code(201);

            echo json_encode([
                'message' => 'Usuario creado correctamente'
            ]);

        } catch (\Exception $e) {

            http_response_code(400);

            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }
}
