<?php

namespace App\Config;

use PDO;

class Database
{
    public static function connect(): PDO
    {
        return new PDO(
            sprintf(
                "mysql:host=%s;port=3306;dbname=%s;charset=utf8mb4",
                $_ENV["DB_HOST"],
                $_ENV["DB_NAME"]
            ),
            $_ENV["DB_USER"],
            $_ENV["DB_PASS"],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
}
