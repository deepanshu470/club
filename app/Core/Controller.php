<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        echo View::render($view, $data);
    }

    protected function redirect(string $route, array $params = []): void
    {
        $url = route_url($route, $params);
        header('Location: ' . $url);
        exit;
    }
}
