<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Repository\UserRepository;
use App\Service\UserService;
use App\Controller\UserController;

$router = new Router();

$userRepository = new UserRepository();

$userService = new UserService($userRepository);

$userController = new UserController($userService);

$router->get('/users', [$userController, 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
