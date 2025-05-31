<?php

use Core\Database;
require_once __DIR__ . '/../Core/Database.php';



function getSearchWords() {

  $pdo = Database::getConnection();

  try {
    // Pas de query aan naar jouw tabel- en kolomnamen
    $stmt = $pdo->query("SELECT SearchWord, Count FROM searchlog ORDER BY Count DESC");
    return $stmt->fetchAll();
  } catch (\PDOException $e) {
    echo "Databasefout: " . htmlspecialchars($e->getMessage());
    return [];
  }
}
