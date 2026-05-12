<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Service\AuthService;
use App\Controller\UserController;
use App\Controller\AuthController;

$router = new Router();

$userRepository = new UserRepository();

$userService = new UserService($userRepository);
$authService = new AuthService($userRepository);

$userController = new UserController($userService);
$authController = new AuthController($authService);

$router->get('/users', [$userController, 'index']);
$router->post('/users', [$userController, 'store']);
$router->post('/login', [$authController, 'login']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
