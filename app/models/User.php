<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO users (name, email, password, phone, address, city, state, pincode)
                VALUES (:name, :email, :password, :phone, :address, :city, :state, :pincode)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':phone' => $data['phone'] ?? null,
            ':address' => $data['address'] ?? null,
            ':city' => $data['city'] ?? null,
            ':state' => $data['state'] ?? null,
            ':pincode' => $data['pincode'] ?? null
        ]);

        return $this->db->lastInsertId();
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET name = :name, phone = :phone, address = :address,
                city = :city, state = :state, pincode = :pincode WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':state' => $data['state'],
            ':pincode' => $data['pincode']
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
