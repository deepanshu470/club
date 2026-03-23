<?php

declare(strict_types=1);

class View
{
    public static function render(string $template, array $data = []): void
    {
        $viewFile = BASE_PATH . '/app/views/' . $template . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
            echo 'View not found';
            return;
        }

        extract($data);
        include BASE_PATH . '/app/views/layout.php';
    }
}
