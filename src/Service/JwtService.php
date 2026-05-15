<?php

namespace App\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    public function generate(array $user): string
    {
        $payload = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'iat' => time(),
            'exp' => time() + 30
        ];

        return JWT::encode(
            $payload,
            $_ENV['JWT_SECRET'],
            'HS256'
        );
    }

    public function validate(
        string $token
    ): object {

        return JWT::decode(
            $token,
            new Key(
                $_ENV['JWT_SECRET'],
                'HS256'
            )
        );
    }
}
