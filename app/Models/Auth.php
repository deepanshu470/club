<?php

namespace App\Models;

class Auth
{
    private const USERNAME = 'admin';
    private const PASSWORD = 'demo123';

    public function attempt(string $username, string $password): bool
    {
        if ($username === self::USERNAME && $password === self::PASSWORD) {
            $_SESSION['admin'] = true;
            return true;
        }

        return false;
    }

    public function check(): bool
    {
        return !empty($_SESSION['admin']);
    }

    public function logout(): void
    {
        unset($_SESSION['admin']);
    }
}
