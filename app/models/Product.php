<?php

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($limit = null) {
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.status = 'active' ORDER BY p.created_at DESC";

        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getFeatured($limit = 8) {
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.featured = TRUE AND p.status = 'active'
                ORDER BY p.created_at DESC LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function search($keyword) {
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE (p.name LIKE :keyword OR p.description LIKE :keyword)
                AND p.status = 'active'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':keyword' => "%$keyword%"]);
        return $stmt->fetchAll();
    }

    public function getByCategory($categoryId) {
        $sql = "SELECT p.*, c.name as category_name FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :category_id AND p.status = 'active'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category_id' => $categoryId]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO products (category_id, name, slug, description, price, discount_price, stock, image, featured)
                VALUES (:category_id, :name, :slug, :description, :price, :discount_price, :stock, :image, :featured)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE products SET category_id = :category_id, name = :name, slug = :slug,
                description = :description, price = :price, discount_price = :discount_price,
                stock = :stock, image = :image, featured = :featured WHERE id = :id";

        $data[':id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getReviews($productId) {
        $sql = "SELECT r.*, u.name as user_name FROM reviews r
                JOIN users u ON r.user_id = u.id
                WHERE r.product_id = :product_id ORDER BY r.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $productId]);
        return $stmt->fetchAll();
    }

    public function getAverageRating($productId) {
        $sql = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews
                FROM reviews WHERE product_id = :product_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $productId]);
        return $stmt->fetch();
    }
}
