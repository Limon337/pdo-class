<?php
require 'db.php';  // Include the db.php file where the $pdo is initialized

class User {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $user = new User($pdo);  // Pass the $pdo object to the User class
    $message = $user->addUser($name, $email);
    echo $message;
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Enter Name" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <button type="submit">Add User</button>
</form>
