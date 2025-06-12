<?php

use Core\Database;
require_once __DIR__ . '/../Core/Database.php';



function getSearchWords() {

  $pdo = Database::getConnection();

  try {
    $stmt = $pdo->query("SELECT SearchWord, Count FROM searchlog ORDER BY Count DESC");
    return $stmt->fetchAll();
  } catch (\PDOException $e) {
    echo "Databasefout: " . htmlspecialchars($e->getMessage());
    return [];
  }
}
function searchWordExists($searchWord) {
    $pdo = Database::getConnection();

    try {
        $stmt = $pdo->prepare("SELECT 1 FROM articles WHERE `Name` LIKE ? LIMIT 1");
        $stmt->execute(['%' . $searchWord . '%']);
        return $stmt->fetch() !== false;
    } catch (\PDOException $e) {
        echo "Databasefout: " . htmlspecialchars($e->getMessage());
        return false;
    }
}

function deleteSearchWord($searchWord) {
  $pdo = Database::getConnection();

  try {
    $stmt = $pdo->prepare("DELETE FROM searchlog WHERE SearchWord = ?");
    return $stmt->execute([$searchWord]);
  } catch (\PDOException $e) {
    echo "Databasefout: " . htmlspecialchars($e->getMessage());
    return false;
  }
}


