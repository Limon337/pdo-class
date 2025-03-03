<?php
require 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);

if ($stmt->execute(['id' => $id])) {
    echo "User deleted successfully!";
} else {
    echo "Error deleting user!";
}
?>
