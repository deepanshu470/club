<?php

declare(strict_types=1);

abstract class BaseController
{
    protected function render(string $template, array $data = []): void
    {
        View::render($template, $data);
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }
}
