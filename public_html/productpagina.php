<?php
use Models\CrudModel;
// zoekwoorden toevoegen aan database
if(!isempty($_GET['zoekwoord'])){
    // voeg het zoekwoord toe aan de database toe
    $tableName = "searchlog";
    $searchword = $_GET['zoekwoord'];
    $searchWordArray = ['SearchWord' => $searchword];
    CrudModel::createData($tableName, $searchWordArray);
}

// Laad de controller en haal de data op
$data = require_once __DIR__ . '/../project_root/Controllers/product_list_controller.php';

// Extraheer de variabelen uit de controller naar losse variabelen
extract($data);

// Laad de view (HTML weergave)
require_once __DIR__ . '/views/product_list_view.php';
