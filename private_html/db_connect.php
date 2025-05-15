<?php
// db_connect.php

class Database {
    private $host = 'localhost';
    private $db = 'fittingly_db';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>