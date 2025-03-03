<?php
require_once 'class.database.php';

class Manage {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Method to get all users
    public function getUsers() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to render the HTML table
    public function renderUserTable() {
        $users = $this->getUsers();
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>';
        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($user['id']) . '</td>';
            echo '<td>' . htmlspecialchars($user['name']) . '</td>';
            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
            echo '<td>';
            echo '<a href="edit.php?id=' . $user['id'] . '">Edit</a> ';
            echo '<a href="delete.php?id=' . $user['id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

?>