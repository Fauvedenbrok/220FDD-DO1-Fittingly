<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

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
                // Wanneer PDO::ATTR_EMULATE_PREPARES op false is ingesteld, 
                // worden prepared statements rechtstreeks door de database-engine 
                // verwerkt in plaats van door PHP zelf. Dit kan helpen bij het 
                // voorkomen van SQL-injectie en zorgt ervoor dat bepaalde 
                // datatypen correct worden behandeld door de database.
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
