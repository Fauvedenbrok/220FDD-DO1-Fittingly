<?php
/** Laad de vertaler in en zet 'm klaar */
require_once __DIR__ . '/Lang/translator.php';
$translator = init_translator();

/** Laad de controller en ontvang de data */
$data = require_once __DIR__ . '/../project_root/Controllers/product_detail_controller.php';

/**
 * Controleer of artikel is gevonden.
 * 
 * Als het artikel niet in de database voorkomt, geef dan een melding
 * "Product niet gevonden." en stop de uitvoering van het script.
 */
if (!isset($data['artikel'])) {
    echo "Product niet gevonden.";
    exit;
}

/**
 * Zet de inhoud van de array $data om in losse variabelen.
 * 
 * Hierdoor kun je makkelijker met de gegevens werken zonder steeds $data[...] te typen.
 * Bijvoorbeeld: $data['categorie'] wordt gewoon $categorie.
 * Let op: dit overschrijft bestaande variabelen als ze dezelfde naam hebben.
 */
extract($data);

/** Laad de HTML-view */
require_once __DIR__ . '/views/product_detail_view.php';


