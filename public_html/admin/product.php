<?php

require_once __DIR__ . '/auth_admin.php';

/**
 * Product detail page for the admin panel.
 *
 * Loads the product detail controller, checks if the product exists,
 * extracts variables for the view, and loads the product detail view.
 *
 * @package Admin
 */

/**
 * 1. Load the controller and receive the data.
 * @var array $data Data array returned from the product_detail_controller.
 */
$data = require_once '../../project_root/Controllers/product_detail_controller.php';

/**
 * 2. Check if the article was found.
 * If not, display an error message and stop execution.
 */
if (!isset($data['artikel'])) {
    echo "Product niet gevonden.";
    exit;
}

/**
 * 3. Extract data keys to individual variables for use in the view.
 */
extract($data);

/**
 * 4. Load the HTML view for the product detail page.
 */
require_once 'views/product_detail_view.php';
