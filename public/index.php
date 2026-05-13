<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Env;
use App\Core\Router;
use App\Repository\UserRepository;
use App\Repository\TokenRepository;
use App\Service\UserService;
use App\Service\AuthService;
use App\Controller\UserController;
use App\Controller\AuthController;
use App\Controller\ProfileController;

Env::load();

$router = new Router();

$userRepository = new UserRepository();
$tokenRepository = new TokenRepository();

$userService = new UserService($userRepository);
$authService = new AuthService($userRepository, $tokenRepository);

$userController = new UserController($userService);
$authController = new AuthController($authService);
$profileController = new ProfileController();

$router->get('/users', [$userController, 'index']);
$router->get('/profile', [$profileController, 'index']);

$router->post('/users', [$userController, 'store']);
$router->post('/login', [$authController, 'login']);


$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
