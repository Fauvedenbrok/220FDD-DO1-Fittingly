<?php

use Models\CrudModel;
use Models\Articles;

require_once '../Models/CrudModel.php';
require_once '../Models/Articles.php';
require_once '../Core/Database.php';

/**
 * Handles the update of a product, including optional image upload.
 *
 * - If a new image is uploaded, it is saved and the image path is updated.
 * - If no new image is uploaded, the existing image path is retained.
 * - Updates the product data in the database.
 *
 * @package Controllers
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /**
     * @var int $articleID The ID of the article to update.
     */
    $articleID = $_POST['productID'];
    
    // Directory where the uploaded image will be stored  
    /**
     * @var string $uploadDir Directory where the uploaded image will be stored.
     * @var array $allowedTypes Allowed MIME types for image upload.
     */  
    $uploadDir = __DIR__ . '/../../public_html/Images/productImages/'; // De map waar de afbeelding wordt opgeslagen
    // Allowed MIME types for image upload
    $allowedTypes = ['image/jpeg']; // Toegestane bestandsformaten
    
    /**
     * Handle image upload if a file was actually uploaded.
     * @var string $filePath The path to the uploaded file (if any).
     */
if (isset($_FILES['imagePath']) && !empty($_FILES['imagePath']['tmp_name'])) {
    $file = $_FILES['imagePath'];
    $fileType = mime_content_type($file['tmp_name']); // Controleer het bestandstype

    if (!in_array($fileType, $allowedTypes)) {
        die('Ongeldig bestandstype.');
    }

    // Determine the file name: articleID + correct extension
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = $articleID . '.' . $fileExt;
    $filePath = $uploadDir . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Save the relative path in $_POST['imagePath']
        $_POST['imagePath'] = "Images/productImages/" . $newFileName;
        echo "Upload gelukt! Bestand opgeslagen als: $filePath";
    } else {
        echo "Er is iets misgegaan bij het uploaden van de afbeelding.";
    }
} else {
    /**
     * No new image uploaded, keep the old image path from the database.
     * Fetch the current article data.
     */
    $existingArticle = CrudModel::readAllById('Articles', 'ArticleID', $articleID);
    $_POST['imagePath'] = $existingArticle['ImagePath'] ?? null;
}
    
    /**
     * Create an Articles object from the POST data and update the article.
     * @var Articles $article The article object to update.
     */
    $article = new Articles($_POST['productID'], $_POST['productName'], $_POST['productSize'], 
                        $_POST['productWeight'], $_POST['productWeightUnit'], $_POST['productColor'], 
                        $_POST['productDescription'], $filePath, $_POST['productCategory'], 
                        $_POST['productSubCategory'], $_POST['productMaterial'], 
                        $_POST['productBrand'], $_POST['productAvailability']);
    // Update the article data in the database
    $article->updateArticle();
}
/**
 * Redirect to the product page after update.
 */
header("Location: ../../public_html/admin/product.php?id={$_POST['productID']}&nocookies=true");

