<?php

namespace App\Config;

use Dotenv\Dotenv;

class Env
{
    public static function load(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }
}
