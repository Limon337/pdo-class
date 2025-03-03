<?php
require 'database.php';

class Delete {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(['id' => $id])) {
            return "User deleted successfully!";
        } else {
            return "Error deleting user!";
        }
    }
}