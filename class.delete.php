<?php
require_once 'class.database.php';

class Delete {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
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