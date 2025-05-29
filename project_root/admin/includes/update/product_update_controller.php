<?php

use Models\CrudModel;
use Models\Articles;

require_once '../../../Models/CrudModel.php';
require_once '../../../Models/Articles.php';
require_once '../../../Core/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleID = $_POST['productID'];
    $uploadDir = 'C:\Users\Bart\220FDD-DO1-Fittingly\public_html\Images\productImages/'; // De map waar de afbeelding wordt opgeslagen
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Toegestane bestandsformaten
    
    if (!isset($_FILES['imagePath'])) {
        die('Geen bestand geüpload.');
    }

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
        
        // Hier zou je de database kunnen updaten met het nieuwe pad
        // Bijvoorbeeld: updateImagePathInDB($articleID, $filePath);
    } else {
        echo "Er is iets misgegaan bij het uploaden van de afbeelding.";
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
header("Location: ../../product.php?id={$_POST['productID']}");

