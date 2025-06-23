<?php
namespace Core;

use PDO;
use PDOException;

/**
 * Class Database
 *
 * Singleton class for managing the database connection using PDO.
 * Provides a static method to retrieve a single shared PDO instance.
 */
class Database {
    /**
     * @var PDO|null Holds the singleton PDO instance.
     */
    private static ?PDO $instance = null;

    /**
     * Returns a singleton PDO connection to the database.
     *
     * - If the connection does not exist, it will be created using the provided credentials.
     * - Uses exception mode for errors and disables emulated prepares for security.
     *
     * @throws \Exception If the connection fails.
     * @return PDO The PDO database connection instance.
     */
    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $host = 'localhost';
            $db = 'fittingly_database';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // When PDO::ATTR_EMULATE_PREPARES is set to false,
                // prepared statements are handled by the database engine,
                // which helps prevent SQL injection and ensures correct data types.
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                throw new \Exception('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
