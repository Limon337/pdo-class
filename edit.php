<?php
include './class.edit.php';

// Handling logic for user update
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userClass = new Edit($pdo);  // Pass the $pdo object from db.php

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
