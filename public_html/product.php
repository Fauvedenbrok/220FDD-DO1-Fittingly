<?php
// 1. Laad de controller en ontvang de data
$data = require_once __DIR__ . '/../project_root/Controllers/product_detail_controller.php';

// 2. Controleer of artikel is gevonden
if (!isset($data['artikel'])) {
    echo "Product niet gevonden.";
    exit;
}

// 3. Zet data-keys om naar losse variabelen
extract($data);

// 4. Laad de HTML-view
require_once __DIR__ . '/views/product_detail_view.php';
