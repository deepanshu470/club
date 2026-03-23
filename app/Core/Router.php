<?php

namespace App\Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $name, callable $action): void
    {
        $this->register('GET', $name, $action);
    }

    public function post(string $name, callable $action): void
    {
        $this->register('POST', $name, $action);
    }

    public function dispatch(string $name, string $method): void
    {
        $method = strtoupper($method);

        if (!isset($this->routes[$method][$name])) {
            http_response_code(404);
            echo View::render('partials/404', ['title' => 'Not Found']);
            return;
        }

        $action = $this->routes[$method][$name];
        $action();
    }

    private function register(string $method, string $name, callable $action): void
    {
        $method = strtoupper($method);
        $this->routes[$method][$name] = $action;
    }
}
