<?php

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];

                if ($user['is_admin']) {
                    header('Location: /admin');
                } else {
                    header('Location: /');
                }
                exit;
            } else {
                $_SESSION['error'] = 'Invalid email or password';
            }
        }

        require_once BASE_PATH . '/app/views/user/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'city' => $_POST['city'] ?? '',
                'state' => $_POST['state'] ?? '',
                'pincode' => $_POST['pincode'] ?? ''
            ];

            // Check if email already exists
            if ($this->userModel->findByEmail($data['email'])) {
                $_SESSION['error'] = 'Email already exists';
            } else {
                $userId = $this->userModel->create($data);
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_name'] = $data['name'];
                $_SESSION['user_email'] = $data['email'];
                $_SESSION['is_admin'] = false;

                header('Location: /');
                exit;
            }
        }

        require_once BASE_PATH . '/app/views/user/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}
