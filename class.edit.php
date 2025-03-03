<?php

require 'database.php';  // Include the db.php file to get the PDO object

// User class definition
class Edit {
    private $pdo;

    // Constructor to initialize PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch user by ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Update user data
    public function updateUser($id, $name, $email) {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['name' => $name, 'email' => $email, 'id' => $id]);
    }
}
?>