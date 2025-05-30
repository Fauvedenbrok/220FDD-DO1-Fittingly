<?php



function getSearchWords() {
  // Databaseverbinding maken (pas deze gegevens aan naar jouw situatie)
  $host = 'localhost';
  $db   = 'fittingly_database';
  $user = 'root';
  $pass = '';
  $charset = 'utf8mb4';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Pas de query aan naar jouw tabel- en kolomnamen
    $stmt = $pdo->query("SELECT SearchWord, Count FROM searchlog ORDER BY Count DESC");
    return $stmt->fetchAll();
  } catch (\PDOException $e) {
    echo "Databasefout: " . htmlspecialchars($e->getMessage());
    return [];
  }
}
