<?php

class CheckoutController {
    private $orderModel;
    private $productModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->productModel = new Product();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header('Location: /cart');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findById($_SESSION['user_id']);

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->findById($productId);
            if ($product) {
                $price = $product['discount_price'] ?? $product['price'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $price * $quantity
                ];
                $total += $price * $quantity;
            }
        }

        require_once BASE_PATH . '/app/views/checkout/index.php';
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            header('Location: /cart');
            exit;
        }

        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->findById($productId);
            if ($product) {
                $price = $product['discount_price'] ?? $product['price'];
                $total += $price * $quantity;
            }
        }

        $orderData = [
            ':user_id' => $_SESSION['user_id'],
            ':order_number' => $this->orderModel->generateOrderNumber(),
            ':total_amount' => $total,
            ':payment_method' => $_POST['payment_method'] ?? 'cod',
            ':shipping_address' => $_POST['address'],
            ':shipping_city' => $_POST['city'],
            ':shipping_state' => $_POST['state'],
            ':shipping_pincode' => $_POST['pincode'],
            ':shipping_phone' => $_POST['phone'],
            ':notes' => $_POST['notes'] ?? ''
        ];

        $orderId = $this->orderModel->create($orderData);

        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->findById($productId);
            if ($product) {
                $price = $product['discount_price'] ?? $product['price'];
                $this->orderModel->addOrderItem($orderId, $productId, $quantity, $price);
            }
        }

        // Clear cart
        unset($_SESSION['cart']);
        $_SESSION['success'] = 'Order placed successfully!';

        header('Location: /orders');
        exit;
    }
}
