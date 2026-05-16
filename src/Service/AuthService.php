<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Service\JwtService;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private JwtService $jwtService
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

            $user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $token = $this->jwtService->generate($user);

            return [
                'token' => $token,
                'user' => $user
            ];

        } catch (\Exception $e) {
            throw new \Exception('Error al iniciar sesión: ' . $e->getMessage());
        }
    }
}
