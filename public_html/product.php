<?php
/**
 * product.php
 *
 * Product detail page controller for Fittingly.
 * - Loads the Translator for multilingual support.
 * - Loads the product detail controller to fetch product data.
 * - Checks if the requested product exists; if not, displays an error message.
 * - Extracts controller data into variables for easier access in the view.
 * - Loads the product detail view for display.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 * @var array $data        Data array returned from the product_detail_controller.
 * @var object $artikel    The article object for the requested product.
 * @var string $categorie  The product's category.
 * @var string $categorieClass CSS class for category-based styling.
 */

require_once __DIR__ . '/Lang/Translator.php';
$translator = init_translator();

$data = require_once __DIR__ . '/../project_root/Controllers/product_detail_controller.php';

/**
 * Check if the article was found.
 * If not, display an error message and stop script execution.
 */
if (!isset($data['artikel'])) {
    echo "Product niet gevonden.";
    exit;
}

/**
 * Extract the contents of $data into separate variables.
 * This allows easier access to data in the view.
 * Note: This will overwrite existing variables with the same names.
 */
extract($data);

/** 
 * Load the HTML view for the product detail page. 
 */
require_once __DIR__ . '/views/product_detail_view.php';


