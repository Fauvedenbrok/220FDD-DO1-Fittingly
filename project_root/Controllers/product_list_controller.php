<?php

use Core\Database;
use Repositories\ArticlesRepository;

require_once __DIR__ . '/../../public_html/Lang/translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

$translator = init_translator();

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
