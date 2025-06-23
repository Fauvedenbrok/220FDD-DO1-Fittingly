<?php
/**
 * product_list_controller.php
 *
 * Controller for retrieving and preparing product list data for the view.
 * - Connects to the database and initializes the ArticlesRepository.
 * - Retrieves search filters from the URL (GET parameters).
 * - Fetches filtered articles from the database.
 * - Returns an array with the articles, search term, and category for use in the view.
 */

use Core\Database;
use Repositories\ArticlesRepository;

require_once __DIR__ . '/../../public_html/Lang/Translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

$translator = init_translator();

/**
 * Initialize the database connection and the articles repository.
 *
 * @var Database $db Database object for connection.
 * @var PDO $pdo The PDO database connection.
 * @var ArticlesRepository $articlesRepo Repository for article data.
 */
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

/**
 * Retrieve search filters from the URL (GET parameters).
 *
 * @var string $zoekwoord Search term entered by the user (empty if not provided).
 * @var string $categorie Selected category from dropdown (empty if not selected).
 */
$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';

/**
 * Fetch filtered articles matching the search term and category using the repository.
 *
 * @var array $artikelen List of article objects matching the filters.
 */
$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);

/**
 * Return the collected data to the view page.
 *
 * @return array{
 *     artikelen: array,   // List of found articles.
 *     zoekwoord: string,  // Search term entered by the user.
 *     categorie: string   // Selected category.
 * }
 */
return [
    'artikelen' => $artikelen,
    'zoekwoord' => $zoekwoord,
    'categorie' => $categorie,
];
