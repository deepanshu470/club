<?php

class UserController {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = new User();
        $this->orderModel = new Order();
    }

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user = $this->userModel->findById($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'pincode' => $_POST['pincode']
            ];

            $this->userModel->update($_SESSION['user_id'], $data);
            $_SESSION['user_name'] = $data['name'];
            $_SESSION['success'] = 'Profile updated successfully';

            header('Location: /profile');
            exit;
        }

        require_once BASE_PATH . '/app/views/user/profile.php';
    }

    public function orders() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $orders = $this->orderModel->getUserOrders($_SESSION['user_id']);

        require_once BASE_PATH . '/app/views/user/orders.php';
    }
}
