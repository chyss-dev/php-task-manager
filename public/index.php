<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Env;
use App\Core\Container;
use App\Core\Router;
use App\Repository\UserRepository;
use App\Service\JwtService;
use App\Service\UserService;
use App\Service\AuthService;
use App\Controller\UserController;
use App\Controller\AuthController;
use App\Controller\ProfileController;

Env::load();

$container = new Container();

$container->set(UserRepository::class, fn() => new UserRepository());

$container->set(JwtService::class, fn() => new JwtService());

$container->set(
    UserService::class,
    fn($c) => new UserService($c->get(UserRepository::class))
);
$container->set(
    AuthService::class,
    fn($c) => new AuthService(
        $c->get(UserRepository::class),
        $c->get(JwtService::class)
    )
);

$container->set(
    UserController::class,
    fn($c) => new UserController($c->get(UserService::class))
);
$container->set(
    AuthController::class,
    fn($c) => new AuthController($c->get(AuthService::class))
);
$container->set(
    ProfileController::class,
    fn() => new ProfileController()
);

$router = new Router();

$router->get('/users', [$container->get(UserController::class), 'index']);
$router->post('/users', [$container->get(UserController::class), 'store']);
$router->post('/login', [$container->get(AuthController::class), 'login']);
$router->get('/profile', [$container->get(ProfileController::class), 'index']);

$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
