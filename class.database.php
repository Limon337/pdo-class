<?php
class Database {
    private $host = "localhost"; 
    private $port = "3308";       
    private $dbname = "pdo";      
    private $username = "root";  
    private $password = ""; 
    private $pdo;

    public function __construct() {
        $this->connect(); 
    }

    private function connect() {
        try {
            // Set the DSN for the PDO connection with port 3308
            $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", 
                                  $this->username, $this->password, [
                                      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                                  ]);
            echo "Database connected successfully!";
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage()); 
        }
    }

    public function getConnection() {
        return $this->pdo; 
    }
}