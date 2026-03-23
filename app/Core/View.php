<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): string
    {
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            return 'View not found: ' . $view;
        }

        extract($data);
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        ob_start();
        include __DIR__ . '/../Views/layout.php';

        return (string) ob_get_clean();
    }
}
