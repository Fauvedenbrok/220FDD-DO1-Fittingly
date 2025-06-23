<?php

use Core\Database;
require_once __DIR__ . '/../Core/Database.php';


/**
 * Retrieves all search words and their counts from the search log.
 *
 * @return array List of search words and their count.
 */
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

/**
 * Checks if a search word exists in the articles table.
 *
 * @param string $searchWord The word to search for.
 * @return bool True if the search word exists, false otherwise.
 */
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

/**
 * Deletes a search word from the search log.
 *
 * @param string $searchWord The search word to delete.
 * @return bool True on success, false otherwise.
 */
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


