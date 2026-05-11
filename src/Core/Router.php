<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $callback = $this->routes[$method][$path] ?? null;

        if (!$callback) {
            http_response_code(404);

            echo json_encode([
                'error' => 'Ruta no encontrada'
            ]);

            return;
        }

        call_user_func($callback);
    }
}
