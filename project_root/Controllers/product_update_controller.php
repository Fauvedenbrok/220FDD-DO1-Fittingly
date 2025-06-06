<?php

use Models\CrudModel;
use Models\Articles;

require_once '../Models/CrudModel.php';
require_once '../Models/Articles.php';
require_once '../Core/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleID = $_POST['productID'];
    
    // deze regel moest ik naar de juiste map zetten omdat die de map anders niet kon vinden..
    $uploadDir = 'C:\Users\bartk\Documents\Avans\Fittingly\220FDD-DO1-Fittingly\public_html\Images\productImages/'; // De map waar de afbeelding wordt opgeslagen
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Toegestane bestandsformaten
    
    // Only handle image upload if a file was actually uploaded
if (isset($_FILES['imagePath']) && !empty($_FILES['imagePath']['tmp_name'])) {
    $file = $_FILES['imagePath'];
    $fileType = mime_content_type($file['tmp_name']); // Controleer het bestandstype

    if (!in_array($fileType, $allowedTypes)) {
        die('Ongeldig bestandstype.');
    }

    // Bepaal de bestandsnaam: articleID + de juiste extensie
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = $articleID . '.' . $fileExt;
    $filePath = $uploadDir . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Bewaar het relatieve pad in $_POST['imagePath']
        $_POST['imagePath'] = "Images/productImages/" . $newFileName;
        echo "Upload gelukt! Bestand opgeslagen als: $filePath";
    } else {
        echo "Er is iets misgegaan bij het uploaden van de afbeelding.";
    }
} else {
    // No new image uploaded, keep the old image path from the database
    // Fetch the current article data
    $existingArticle = CrudModel::readAllById('Articles', 'ArticleID', $articleID);
    $_POST['imagePath'] = $existingArticle['ImagePath'] ?? null;
}
    
    // van de gegevens een Article object maken
    $article = new Articles($_POST['productID'], $_POST['productName'], $_POST['productSize'], 
                        $_POST['productWeight'], $_POST['productWeightUnit'], $_POST['productColor'], 
                        $_POST['productDescription'], $filePath, $_POST['productCategory'], 
                        $_POST['productSubCategory'], $_POST['productMaterial'], 
                        $_POST['productBrand'], $_POST['productAvailability']);
    // data van het artikel updaten
    $article->updateArticle();
}
header("Location: ../../public_html/admin/product.php?id={$_POST['productID']}");

