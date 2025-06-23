<?php
/**
 * productpagina.php
 *
 * Product overview page controller for Fittingly.
 * - Loads the Translator for multilingual support.
 * - Handles search logging: saves or updates search keywords in the database.
 * - Loads the product list controller to fetch product data.
 * - Extracts controller data into variables for easier access in the view.
 * - Loads the product list view for display.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 * @var array $data        Data array returned from the product_list_controller.
 * @var array $artikelen   List of article objects to display.
 * @var string $zoekwoord  The current search keyword (from GET).
 * @var string $categorie  The selected category (from GET).
 */

require_once 'Lang/Translator.php';
$translator = init_translator();

/**
 * Activate classes via namespaces to avoid conflicts.
 * - CrudModel: class for Create, Read, Update, Delete actions.
 * - DataBase: class for database connections.
 */
use Models\CrudModel;
use Core\DataBase;

require_once '../project_root/Models/CrudModel.php';
require_once '../project_root/Core/Database.php';

/**
 * Checks if a search keyword is provided via the URL and is not empty.
 * - If the keyword exists in the searchlog table, increments its count.
 * - Otherwise, inserts the new keyword into the searchlog table.
 *
 * @var string $searchword The search term entered by the user.
 * @var string $tableName  The name of the database table for search logging.
 */
if (isset($_GET['zoekwoord']) && !empty($_GET['zoekwoord'])) {
    $searchword = $_GET['zoekwoord'];
    $tableName = "searchlog";

 if (CrudModel::checkRecordExists($tableName, ['SearchWord' => $searchword])) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE $tableName SET Count = Count + 1 WHERE SearchWord = ?");
        $stmt->execute([$searchword]);
    } else {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO $tableName (SearchWord, Count) VALUES (?, 1)");
        $stmt->execute([$searchword]);
    }
}



/**
 * Load the product list controller and extract data.
 * - $data: Data returned from the controller.
 * - extract($data): Makes controller variables available for the view.
 */
$data = require_once __DIR__ . '/../project_root/Controllers/product_list_controller.php';
extract($data);


/** 
 * Load the HTML view for the product list page. 
 */
require_once __DIR__ . '/views/product_list_view.php';
