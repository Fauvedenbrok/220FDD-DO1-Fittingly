<?php

/**
 * cart_controller.php
 *
 * Controller for handling shopping cart actions.
 * Loads the CartHandler and processes POST requests to add products to the cart.
 */

require_once __DIR__ . '../../public_html/CartHandler.php';
$cartHandler = new CartHandler();

/**
 * Processes adding a product to the shopping cart via a POST request.
 *
 * - Retrieves the product ID and quantity from POST data.
 * - Adds the product to the cart using CartHandler.
 * - Redirects to the product page after adding.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);

    if ($productId && $quantity > 0) {
        $cartHandler->addToCart($productId, $quantity);
        header('Location: productpagina.php');
        exit();
    }
}