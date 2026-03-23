<?php

class Order {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO orders (user_id, order_number, total_amount, payment_method,
                shipping_address, shipping_city, shipping_state, shipping_pincode, shipping_phone, notes)
                VALUES (:user_id, :order_number, :total_amount, :payment_method,
                :shipping_address, :shipping_city, :shipping_state, :shipping_pincode, :shipping_phone, :notes)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $quantity, $price) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (:order_id, :product_id, :quantity, :price)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':order_id' => $orderId,
            ':product_id' => $productId,
            ':quantity' => $quantity,
            ':price' => $price
        ]);
    }

    public function findById($id) {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getOrderItems($orderId) {
        $sql = "SELECT oi.*, p.name as product_name, p.image
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }

    public function getUserOrders($userId) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getAll() {
        $sql = "SELECT o.*, u.name as user_name, u.email as user_email
                FROM orders o
                JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }

    public function generateOrderNumber() {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
