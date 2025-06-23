<?php

/**
 * product_detail_view.php
 *
 * View for displaying and editing the details of a single product (admin).
 * - Shows product image, attributes, and an update form.
 * - Uses ViewHelper for safe HTML output.
 * - Allows admin to update product information and upload a new image.
 *
 * Variables:
 * @var object $artikel        The article object containing product data.
 * @var string $categorieClass The CSS class for category-based styling.
 */

require_once __DIR__ . '/../../../project_root/Helpers/ViewHelper.php';
use Helpers\ViewHelper;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= ViewHelper::e($artikel->getArticleName()); ?></title>
   <link rel="stylesheet" href="../../public_html/css/styles.css">
   <link rel="stylesheet" href="../../public_html/css/product.css">
</head>
<body>

<header></header>

<main>
    <!--    
    /**
     * Container for the product detail page.
     * @class product-detail-container   For CSS styling.
     * @var string $categorieClass       Dynamically adds a category class (e.g., "men", "women").
     */
    -->
    <div class="product-detail-container <?= $categorieClass; ?>">
    <div class="product-detail-layout">
        <!--
        /**
         * Displays the product image or a placeholder if not available.
         * @if $artikel->imageExists()        Checks if an image exists for the product.
         * @getImageUrl()                     Returns the image URL.
         * @getArticleName()                  Returns the product name for alt text.
         * @artikel object                    Contains all product information.
         */
        -->
        <div class="product-detail-image">
            <?php if ($artikel->imageExists()): ?>
                <img src="../../public_html/<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($artikel->getArticleName()); ?>">
            <?php else: ?>
                <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
            <?php endif; ?>
        </div>
        <!--
        /**
         * Form for updating product information as admin (POST).
         * @action string           Points to the controller handling the update.
         * @method POST             Data is sent securely.
         * @enctype multipart/...   Required for file (image) upload.
         */
        -->
        <form action="../../project_root/Controllers/product_update_controller.php" method="post" enctype="multipart/form-data">
        <!--
        /**
         * List of product attributes. Each <li> contains one attribute.
         * @ul.product-attributes      Layout class for styling.
         * @type hidden                Not visible in the UI.
         * @name="productID"           Form field name.
         * @getArticleX()              Methods to get article info: name, description, brand, etc.
         * @method_exists()            Only call if method (price) exists.
         * @getQuantityOfStock()       Method returning stock quantity (int).
         * @'N.v.t.'                   Shown if method (price) is not available.
         */
        -->
        <ul class="product-attributes">
            <li><input type="hidden" id="productID" name="productID" value="<?= ViewHelper::e($artikel->getArticleID()); ?>"></li>
            <li><div class="attr-label">Titel:</div><input type="text" id="productName" name="productName" value="<?= ViewHelper::e($artikel->getArticleName()); ?>" required></li>
            <li><div class="attr-label">Beschrijving:</div><input type="text" id="productDescription" name="productDescription" value="<?= ViewHelper::e($artikel->getArticleDescription()); ?>" required></li>
            <li><div class="attr-label">Merk:</div><input type="text" id="productBrand" name="productBrand" value="<?= ViewHelper::e($artikel->getArticleBrand()); ?>" required></li>
            <li><div class="attr-label">Categorie:</div><input type="text" id="productCategory" name="productCategory" value="<?= ViewHelper::e($artikel->getArticleCategory()); ?>" required></li>
            <li><div class="attr-label">Subcategorie:</div><input type="text" id="productSubCategory" name="productSubCategory" value="<?= ViewHelper::e($artikel->getArticleSubCategory()); ?>" required></li>
            <li><div class="attr-label">Kleur:</div><input type="text" id="productColor" name="productColor" value="<?= ViewHelper::e($artikel->getColor()); ?>" required></li>
            <li><div class="attr-label">Maat:</div><input type="text" id="productSize" name="productSize" value="<?= ViewHelper::e($artikel->getSize()); ?>" required></li>
            <li><div class="attr-label">Materiaal:</div><input type="text" id="productMaterial" name="productMaterial" value="<?= ViewHelper::e($artikel->getArticleMaterial()); ?>" required></li>
            <li><div class="attr-label">Gewicht:</div><input type="text" id="productWeight" name="productWeight" value="<?= ViewHelper::e($artikel->getWeight()); ?>" required></li>
            <li><div class="attr-label">Gewichtseenheid:</div><input type="text" id="productWeightUnit" name="productWeightUnit" value="<?= ViewHelper::e($artikel->getWeightUnit()); ?>" required></li>
            <li><div class="attr-label">Voorraad:</div><input type="text" id="productStock" name="productStock" value="<?= method_exists($artikel, 'getQuantityOfStock') ? ViewHelper::e($artikel->getQuantityOfStock()) : 'N.v.t.'; ?>" required></li>
            <li><div class="attr-label">Prijs:</div><input type="text" id="productPrice" name="productPrice" value="<?= method_exists($artikel, 'getPrice') ? '€' . number_format($artikel->getPrice(), 2, ',', '.') : 'N.v.t.'; ?>" required></li>
            <li><div class="attr-label">Beschikbaar:</div>
                <select id="productAvailability" name="productAvailability" required>
                    <option value="1" <?= $artikel->getArticleAvailability() ? 'selected' : ''; ?>>Ja</option>
                    <option value="0" <?= !$artikel->getArticleAvailability() ? 'selected' : ''; ?>>Nee</option>
                </select>
            </li>
            <!--
            /**
             * Input field for uploading an image (admin).
             * @type file               Required for file selection.
             * @name imagePath          Key for processing in the controller.
             * @accept="image/*"        Restrict file types to images.
             */
            -->
            <li><label for="file">Upload afbeelding:</label>
            <input type="file" name="imagePath" id="file" accept="image/jpeg"></li>

        </ul>
        <button type="submit" name="update">Update Productinformatie</button>
        </form>
        <a href="products.php" class="back-link">← Terug naar overzicht</a>
        </div>
    </div>
</main>

<footer></footer>

<script src="/public_html/js/scripts.js"></script>
  <script>
    includeHTML("../admin/adminheader.php", "header");
  </script>

</body>
</html>
