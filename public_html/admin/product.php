<?php
/**
 * product.php
 *
 * Product detail page for the admin panel.
 * - Secures the page for admin access only.
 * - Loads the product detail controller and retrieves product data.
 * - Checks if the product exists; if not, displays an error and exits.
 * - Extracts controller data for use in the view.
 * - Loads the product detail view for display and editing.
 *
 * Usage:
 * This file is accessed by admins to view and edit a single product.
 *
 * Variables:
 * @var array $data      Data array returned from the product_detail_controller.
 * @var object $artikel  The article object containing product data (from $data).
 */

require_once __DIR__ . '/auth_admin.php';

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
