<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Database;

$pdo = Database::connect();

echo "Conexión OK 🚀\n";
