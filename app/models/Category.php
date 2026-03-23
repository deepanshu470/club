<?php

class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findBySlug($slug) {
        $sql = "SELECT * FROM categories WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO categories (name, slug, description, image)
                VALUES (:name, :slug, :description, :image)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE categories SET name = :name, slug = :slug,
                description = :description, image = :image WHERE id = :id";

        $data[':id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
