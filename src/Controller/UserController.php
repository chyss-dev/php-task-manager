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

        echo json_encode(
            $this->userService->getUsers()
        );
    }
}
