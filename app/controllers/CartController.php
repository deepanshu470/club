<?php

class CartController {
    public function index() {
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;

        if (!empty($cart)) {
            $productModel = new Product();
            $cartItems = [];

            foreach ($cart as $productId => $quantity) {
                $product = $productModel->findById($productId);
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
        } else {
            $cartItems = [];
        }

        require_once BASE_PATH . '/app/views/cart/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $quantity = $_POST['quantity'] ?? 1;

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }

            $_SESSION['success'] = 'Product added to cart';
        }

        header('Location: /cart');
        exit;
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $quantity = $_POST['quantity'] ?? 1;

            if (isset($_SESSION['cart'][$productId])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId] = $quantity;
                } else {
                    unset($_SESSION['cart'][$productId]);
                }
            }
        }

        header('Location: /cart');
        exit;
    }

    public function remove() {
        $productId = $_GET['id'] ?? 0;

        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            $_SESSION['success'] = 'Product removed from cart';
        }

        header('Location: /cart');
        exit;
    }
}
