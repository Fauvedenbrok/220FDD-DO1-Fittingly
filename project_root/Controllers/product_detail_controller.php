<?php
/**
 * product_detail_controller.php
 *
 * Controller for retrieving and preparing product detail data for the view.
 * - Connects to the database and initializes the ArticlesRepository.
 * - Retrieves the product ID from the URL.
 * - Fetches the article from the database.
 * - Handles error cases (invalid ID or article not found).
 * - Generates a CSS class name based on the article category.
 * - Returns an array with the article and the CSS class for use in the view.
 */

use Core\Database;
use Repositories\ArticlesRepository;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

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
 * Retrieve the article ID from the URL (GET parameter).
 *
 * @var int $id The article ID from the URL, or 0 if not set.
 */
$id = (int) ($_GET['id'] ?? 0);

/**
 * If the ID is not valid (0), return an empty array.
 *
 * @return array Empty array if no valid ID is provided.
 */
if (!$id) {
    return []; 
}

/**
 * Find the article in the database by its ID.
 *
 * @var mixed $artikel The article object or null if not found.
 */
$artikel = $articlesRepo->findById($id);

/**
 * If the article does not exist, return an empty array (error handling).
 *
 * @return array Empty array if the article is not found.
 */
if (!$artikel) {
    return []; 
}

/**
 * Generate a CSS class name based on the article category.
 *
 * @var string $categorieClass The CSS-ready class name (e.g., "men-accessories").
 */
$categorieClass = strtolower(str_replace(' ', '-', $artikel->getArticleCategory()));



/**
 * Return the article and the associated CSS class to the view page.
 *
 * @return array{
 *     artikel: object,         // The article object with data.
 *     categorieClass: string   // The CSS class name as a string (e.g., "womans-clothing").
 * }
 */
return [
    'artikel' => $artikel,
    'categorieClass' => $categorieClass
];
