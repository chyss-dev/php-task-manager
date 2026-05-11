<?php

namespace App\Config;

use PDO;

class Database
{
    public static function connect(): PDO
    {
        return new PDO(
            "mysql:host=127.0.0.1;port=3306;dbname=task_manager;charset=utf8mb4",
            "taskManagerUser",
            "secret",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]
        );
    }
}
