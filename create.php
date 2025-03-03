<?php
include './class.create.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $user = new UserCreate($pdo);  // Pass the $pdo object to the User class
    $message = $user->addUser($name, $email);
    echo $message;
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Enter Name" required>
    <input type="email" name="email" placeholder="Enter Email" required>
    <button type="submit">Add User</button>
</form>
