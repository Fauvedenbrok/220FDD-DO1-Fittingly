<?php

use Core\Database;
use Repositories\ArticlesRepository;

// require_once 'Lang/translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

// session_start();

// // Taal instellen
// if (isset($_GET['lang'])) {
//     $_SESSION['lang'] = $_GET['lang'];
// }
// $lang = $_SESSION['lang'] ?? 'nl';
// $translator = new Translator($lang);

// Database & repository
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

// Artikel-ID ophalen uit de URL
$id = (int) ($_GET['id'] ?? 0);

if (!$id) {
    return []; // Geen geldig ID
}

$artikel = $articlesRepo->findById($id);

if (!$artikel) {
    return []; // Artikel niet gevonden
}

$categorieClass = strtolower(str_replace(' ', '-', $artikel->getArticleCategory()));

return [
    'artikel' => $artikel,
    'categorieClass' => $categorieClass
];
