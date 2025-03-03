<?php
include './class.manage.php';

// Instantiate the User class and render the table
$manage = new Manage($pdo);
$manage->renderUserTable();
?>
