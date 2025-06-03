<?php
/** Laad de vertaler in en zet 'm klaar */
require_once __DIR__ . '/Lang/translator.php';
$translator = init_translator();

/** Laad de controller en ontvang de data */
$data = require_once __DIR__ . '/../project_root/Controllers/product_detail_controller.php';

/** Controleer of artikel is gevonden */
if (!isset($data['artikel'])) {
    echo "Product niet gevonden.";
    exit;
}

/** Maakt losse variabelen van array-keys */
extract($data);

/** Laad de HTML-view */
require_once __DIR__ . '/views/product_detail_view.php';
