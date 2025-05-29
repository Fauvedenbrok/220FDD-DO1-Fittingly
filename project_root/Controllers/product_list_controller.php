<?php

use Core\Database;
use Repositories\ArticlesRepository;

// require_once 'Lang/translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

// Session en taalinstelling
// session_start();

// if (isset($_GET['lang'])) {
//     $_SESSION['lang'] = $_GET['lang'];
// }
// $lang = $_SESSION['lang'] ?? 'nl';
// $translator = new Translator($lang);

// Setup database en repository
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

// Zoekfilters
$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';

// Artikelen ophalen
$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);

// Gegevens doorgeven aan view
return [
    'artikelen' => $artikelen,
    'zoekwoord' => $zoekwoord,
    'categorie' => $categorie,
];
