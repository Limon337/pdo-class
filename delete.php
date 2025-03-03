<?php
include './class.delete.php';
// Usage
$user = new Delete($pdo);
$id = $_GET['id'];
echo $user->deleteUser($id);
?>

