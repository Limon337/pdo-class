<?php
include './class.database.php';

// Initialize the Database class and return the PDO instance
$database = new Database();
$pdo = $database->getConnection();
?>
