<?php

namespace App\Service;

use App\Repository\UserRepository;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function login(string $email, string $password): array
    {
        if (empty($email) || empty($password)) {
            throw new \Exception('Email y contraseña son obligatorios');
        }

        try {
            $user = $this->userRepository->findByEmail($email);

            if (!$user) {
                throw new \Exception('Credenciales inválidas');
            }

            $validPassword = password_verify($password, $user['password']);

            if (!$validPassword) {
                throw new \Exception('Credenciales inválidas');
            }

            return [
                'token' => bin2hex(random_bytes(32)),
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ]
            ];

        } catch (\Exception $e) {
            throw new \Exception('Error al iniciar sesión: ' . $e->getMessage());
        }
    }
}
