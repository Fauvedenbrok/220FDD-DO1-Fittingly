<?php
namespace Tests;
use Tests\Database;
use PDO;

require_once 'Database.php';


class CrudModel
{
    
    public static function createData(string $table, array $data) {
    $pdo = Database::getConnection();
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));
    $query = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(array_values($data));
    }

    public static function readAllById(string $tableName, string $columnName, $id) : array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [];
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

    public static function readAllByColumn(string $tableName, string $columnName, $value): array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function updateData(string $table, array $data) {
    $pdo = Database::getConnection();
    $primaryKey = array_key_first($data); // Get the first key (e.g., ArticleID, UserID, etc.)
    $id = array_shift($data); // Remove the first element (ID) from the array
    $set = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));
    $query = "UPDATE {$table} SET $set WHERE {$primaryKey} = ?";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([...array_values($data), $id]);
    }

    public static function checkRecordExists(string $table, array $data) {
    $pdo = Database::getConnection();
    $primaryKey = array_key_first($data);
    $id = array_shift($data);
    $query = "SELECT COUNT(*) FROM {$table} WHERE {$primaryKey} = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
    }

    public static function getForeignKeyValue(string $tableName, string $searchColumn, $searchValue, string $foreignKeyColumn) {
        $pdo = Database::getConnection();
        $query = "SELECT {$foreignKeyColumn} FROM {$tableName} WHERE {$searchColumn} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$searchValue]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[$foreignKeyColumn] ?? null;
    }

}