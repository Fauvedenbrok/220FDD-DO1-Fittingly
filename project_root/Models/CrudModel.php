<?php
namespace Models;
use Core\Database;
use PDO;

require_once __DIR__ . '/../Core/Database.php';

/**
 * Class CrudModel
 *
 * Provides generic CRUD operations for database tables.
 *
 * @package Models
 */
class CrudModel
{
    /**
     * Inserts a new record into the specified table.
     *
     * @param string $table The table name.
     * @param array $data Associative array with column names as keys and values to insert.
     * @return bool True on success, false on failure.
     */
    // $data should be an associative array
    // with column names as keys and values to insert
    public static function createData(string $table, array $data) {
    $pdo = Database::getConnection();
    // 'key1', 'key2', 'key3' etc
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));
    // INSERT INTO 'Articles' 'kolomnaam1', 'kolomnaam2' etc VALUES ?, ?, etc
    $query = "INSERT INTO {$table} ($columns) VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute(array_values($data));
    }

    /**
     * Reads a single record from a table by a specific column value.
     *
     * @param string $tableName The table name.
     * @param string $columnName The column to search by.
     * @param mixed $id The value to search for.
     * @return array The found record as an associative array, or an empty array if not found.
     */
    public static function readAllById(string $tableName, string $columnName, $id) : array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public static function readAllByTwoKeys(string $tableName, string $columnOne, $valueOne, $columnTwo, $valueTwo) : array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnOne} = ? AND {$columnTwo} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$valueOne, $valueTwo]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    /**
     * Reads all records from a table.
     *
     * @param string $tableName The table name.
     * @return array Array of associative arrays for each record.
     */
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
    
    /**
     * Reads all records from a table where a column matches a value.
     *
     * @param string $tableName The table name.
     * @param string $columnName The column to search by.
     * @param mixed $value The value to search for.
     * @return array Array of associative arrays for each matching record.
     */
    public static function readAllByColumn(string $tableName, string $columnName, $value): array {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM {$tableName} WHERE {$columnName} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Updates a record in the specified table.
     *
     * @param string $table The table name.
     * @param array $data Associative array with column names as keys and values to update.
     *                    The first key/value pair is assumed to be the primary key.
     * @return bool True on success, false on failure.
     */
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

    /**
     * Checks if a record exists in the specified table by primary key.
     *
     * @param string $table The table name.
     * @param array $data Associative array with the primary key as the first key.
     * @return int The number of matching records (0 or 1).
     */
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

    /**
     * Gets the value of a foreign key column from a table by searching another column.
     *
     * @param string $tableName The table name.
     * @param string $searchColumn The column to search by.
     * @param mixed $searchValue The value to search for.
     * @param string $foreignKeyColumn The foreign key column to retrieve.
     * @return mixed|null The value of the foreign key column, or null if not found.
     */
    public static function getForeignKeyValue(string $tableName, string $searchColumn, $searchValue, string $foreignKeyColumn) {
        $pdo = Database::getConnection();
        $query = "SELECT {$foreignKeyColumn} FROM {$tableName} WHERE {$searchColumn} = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$searchValue]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[$foreignKeyColumn] ?? null;
    }

}