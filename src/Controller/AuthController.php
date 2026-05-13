<?php

namespace App\Controller;

use App\Service\AuthService;

class AuthController
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    public function login(): void
    {
        header('Content-Type: application/json');

        try {

            $data = json_decode(
                file_get_contents('php://input'),
                true
            );

            $result = $this->authService->login(
                $data['email'] ?? '',
                $data['password'] ?? ''
            );

            echo json_encode($result);

        } catch (\Exception $e) {

            http_response_code(400);

            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
