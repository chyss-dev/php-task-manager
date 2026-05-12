<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function getUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function createUser(array $data): bool
    {
        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {
            throw new \Exception('Todos los campos son obligatorios');
        }

        $hashedPassword = password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        );

        return $this->userRepository->create(
            $data['name'],
            $data['email'],
            $hashedPassword
        );
    }
}
