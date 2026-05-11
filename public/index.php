<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controller\UserController;

$router = new Router();

$userController = new UserController();

$router->get('/users', [$userController, 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
