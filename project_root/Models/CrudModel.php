<?php
namespace Models;
use Core\Database;
use PDO;

class CrudModel
{
    // $data should be an associative array
    // with column names as keys and values to insert
    public static function createData(string $table, array $data) {
    $pdo = Database::getConnection();
    // 'waarde1', 'waarde2'
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));
    // INSERT INTO 'Articles' 'kolomnaam1', 'kolomnaam2' etc VALUES ?, ?, etc
    $query = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(array_values($data));
    }

    public static function readAllById(string $tableName, string $columnName, int $id) : array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function readAll(string $tableName) : array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName}";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $objects = [];
        foreach ($rows as $row) {
            $objects[] = $row;
        }

        return $objects;
    }
    
    // $data should be an associative array
    // with column names as keys and values to update
    public static function updateData(string $table, array $data) {
    $pdo = Database::getConnection();
    // Extract the first key as the primary key column and its value as the ID
    $primaryKey = array_key_first($data); // Get the first key (e.g., ArticleID, UserID, etc.)
    $id = array_shift($data); // Remove the first element (ID) from the array
    // Build the SET part of the query
    $set = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));
    // UPDATE Articles SET Name = ?, Size = ?, etc WHERE ArticleID = ?
    $query = "UPDATE {$table} SET $set WHERE {$primaryKey} = ?";
    $stmt = $pdo->prepare($query);
    // alle ?'s worden gevuld de values van de array
    return $stmt->execute([...array_values($data), $id]);
    }

    public static function checkRecordExists(string $table, array $data) {
    $pdo = Database::getConnection();
    // Extract the first key as the primary key column and its value as the ID
    $primaryKey = array_key_first($data);
    $id = array_shift($data);
    // Prepare and execute the query
    $query = "SELECT COUNT(*) FROM {$table} WHERE {$primaryKey} = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
    }

    // public function delete($id) {
    //     $query = "DELETE FROM {$this->table} WHERE id = :id";
    //     $stmt = $this->pdo->prepare($query);
    //     return $stmt->execute(['id' => $id]);
    // }

}