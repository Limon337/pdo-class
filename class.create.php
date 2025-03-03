<?php

require 'database.php';  // Include the db.php file where the $pdo is initialized

class UserCreate {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addUser($name, $email) {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute(['name' => $name, 'email' => $email])) {
            return "User added successfully!";
        } else {
            return "Error adding user!";
        }
    }
}