<?php

class WishlistController {
    private $db;
    private $productModel;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->productModel = new Product();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $sql = "SELECT p.* FROM wishlist w
                JOIN products p ON w.product_id = p.id
                WHERE w.user_id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $wishlistItems = $stmt->fetchAll();

        require_once BASE_PATH . '/app/views/user/wishlist.php';
    }

    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;

            $sql = "INSERT IGNORE INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'],
                ':product_id' => $productId
            ]);

            $_SESSION['success'] = 'Added to wishlist';
        }

        header('Location: /wishlist');
        exit;
    }

    public function remove() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $productId = $_GET['id'] ?? 0;

        $sql = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':product_id' => $productId
        ]);

        $_SESSION['success'] = 'Removed from wishlist';

        header('Location: /wishlist');
        exit;
    }
}
