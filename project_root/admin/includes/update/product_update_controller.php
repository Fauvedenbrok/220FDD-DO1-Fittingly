<?php

use Models\CrudModel;
use Models\Articles;

require_once '../../../Models/CrudModel.php';
require_once '../../../Models/Articles.php';
require_once '../../../Core/Database.php';

// gegevens ophalen uit de database van artikel met id: $_POST['productID']
$data = CrudModel::readAllById("Articles", "ArticleID", $_POST['productID']);
// van de gegevens een Article object maken
$article = new Articles(...array_values($data));
// data van het artikel updaten
$article->updateArticle();

