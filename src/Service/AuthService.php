<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\TokenRepository;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private TokenRepository $tokenRepository
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

            $token = bin2hex(random_bytes(32));
            $user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];

            $this->tokenRepository->create($user['id'], $token);

            return [
                'token' => $token,
                'user' => $user
            ];

        } catch (\Exception $e) {
            throw new \Exception('Error al iniciar sesión: ' . $e->getMessage());
        }
    }
}
