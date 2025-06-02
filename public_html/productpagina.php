<?php

require_once 'Lang/translator.php';
$translator = init_translator();

use Models\CrudModel;
use Core\DataBase;



require_once '../project_root/Models/CrudModel.php';
require_once '../project_root/Core/Database.php';
// zoekwoorden toevoegen aan database
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

// Laad de controller en haal de data op
$data = require_once __DIR__ . '/../project_root/Controllers/product_list_controller.php';

// Extraheer de variabelen uit de controller naar losse variabelen
extract($data);

// Laad de view (HTML weergave)
require_once __DIR__ . '/views/product_list_view.php';
