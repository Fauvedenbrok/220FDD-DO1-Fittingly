<?php
require_once __DIR__ . '/../../Helpers/ViewHelper.php';
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
    <div class="product-detail-container <?= $categorieClass; ?>">
    <div class="product-detail-layout">
        <div class="product-detail-image">
            <?php if ($artikel->imageExists()): ?>
                <img src="../../public_html/<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($artikel->getArticleName()); ?>">
            <?php else: ?>
                <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
            <?php endif; ?>
        </div>

        <div class="product-detail-info">
            <h2><?= viewHelper::e($artikel->getArticleName()); ?></h2>

            <p class="product-description">
                <?= ViewHelper::eWithBreaks($artikel->getArticleDescription()); ?>
            </p>
        <form action="includes/update/product_update_controller.php" method="post">
        <ul class="product-attributes">
            <li><div class="attr-label">Product ID:</div><input type="text" id="productID" name="productID" value="<?= ViewHelper::e($artikel->getArticleID()); ?>"></li>
            <li><div class="attr-label">Merk:</div><input type="text" id="productBrand" value="<?= ViewHelper::e($artikel->getArticleBrand()); ?>"></li>
            <li><div class="attr-label">Categorie:</div><input type="text" id="productCategory" value="<?= ViewHelper::e($artikel->getArticleCategory()); ?>"></li>
            <li><div class="attr-label">Subcategorie:</div><input type="text" id="productSubCategory" value="<?= ViewHelper::e($artikel->getArticleSubCategory()); ?>"></li>
            <li><div class="attr-label">Kleur:</div><input type="text" id="productColor" value="<?= ViewHelper::e($artikel->getColor()); ?>"></li>
            <li><div class="attr-label">Maat:</div><input type="text" id="productSize" value="<?= ViewHelper::e($artikel->getSize()); ?>"></li>
            <li><div class="attr-label">Materiaal:</div><input type="text" id="productMaterial" value="<?= ViewHelper::e($artikel->getArticleMaterial()); ?>"></li>
            <li><div class="attr-label">Gewicht:</div><input type="text" id="productWeight" value="<?= ViewHelper::e($artikel->getWeight()) . ' ' . ViewHelper::e($artikel->getWeightUnit()); ?>"></li>
            <li><div class="attr-label">Voorraad:</div><input type="text" id="productStock" value="<?= method_exists($artikel, 'getQuantityOfStock') ? ViewHelper::e($artikel->getQuantityOfStock()) : 'N.v.t.'; ?>"></li>
            <li><div class="attr-label">Prijs:</div><input type="text" id="productPrice" value="<?= method_exists($artikel, 'getPrice') ? '€' . number_format($artikel->getPrice(), 2, ',', '.') : 'N.v.t.'; ?>"></li>
            <li><div class="attr-label">Beschikbaar:</div>
                <select id="productAvailability">
                    <option value="1" <?= $artikel->getArticleAvailability() ? 'selected' : ''; ?>>Ja</option>
                    <option value="0" <?= !$artikel->getArticleAvailability() ? 'selected' : ''; ?>>Nee</option>
                </select>
            </li>
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
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>

</body>
</html>
