<?php

require_once __DIR__ . '../../public_html/CartHandler.php';
$cartHandler = new CartHandler();

// Verwerken winkelwagen toevoeging via CartHandler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);

    if ($productId && $quantity > 0) {
        $cartHandler->addToCart($productId, $quantity);
        header('Location: productpagina.php');
        exit();
    }
}