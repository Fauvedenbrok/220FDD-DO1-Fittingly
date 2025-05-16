<?php
namespace Models;
use Core\Database;

class CrudModel {
    protected $table;
    protected $pdo;

    public function __construct($table, $pdo) {
        $this->table = $table;
        $this->pdo = new Database();
    }

    // $data should be an associative array
    // with column names as keys and values to insert
    public function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }

    public function read($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // $data should be an associative array
    // with column names as keys and values to update
    public function update($id, $data) {
        $set = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = "UPDATE {$this->table} SET $set WHERE id = :id";
        
        $stmt = $this->pdo->prepare($query);
        $data['id'] = $id; // Add ID to data array
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}

// Usage:
//$pdo = new PDO("mysql:host=localhost;dbname=my_database", "root", "");
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $userModel = new CrudModel("users", $pdo);
//$userModel->create(["name" => "John Doe", "email" => "john@example.com"]);