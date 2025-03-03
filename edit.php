<?php
require 'db.php';  // Include the db.php file to get the PDO object

// User class definition
class User {
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

// Handling logic for user update
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userClass = new User($pdo);  // Pass the $pdo object from db.php

    // Fetch user data by ID
    $user = $userClass->getUserById($id);

    // Form submission for updating user data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];

        if ($userClass->updateUser($id, $name, $email)) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user!";
        }
    }
} else {
    echo "User ID not provided!";
}
?>

<!-- HTML Form for user update -->
<form method="POST">
    <input type="text" name="name" value="<?= isset($user) ? $user['name'] : '' ?>" required>
    <input type="email" name="email" value="<?= isset($user) ? $user['email'] : '' ?>" required>
    <button type="submit">Update</button>
</form>
