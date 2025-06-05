<?php
use Helpers\ViewHelper;
require_once __DIR__ . '/../../project_root/Helpers/ViewHelper.php';

if(isset($_GET['id'])){
    $_SESSION['id'] = $_GET['id'];
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= ViewHelper::e($artikel->getArticleName()); ?></title>
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/product.css">
</head>
<body>

<header></header>

<main>
    <div class="product-detail-container <?= $categorieClass; ?>">
    <div class="product-detail-layout">
        <div class="product-detail-image">
            <?php if ($artikel->imageExists()): ?>
                <img src="<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($artikel->getArticleName()); ?>">
            <?php else: ?>
                <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
            <?php endif; ?>
        </div>

        <div class="product-detail-info">
            <h2><?= viewHelper::e($artikel->getArticleName()); ?></h2>

            <p class="product-description">
                <?= ViewHelper::eWithBreaks($artikel->getArticleDescription()); ?>
            </p>

        <ul class="product-attributes">
            <li><div class="attr-label"><?= $translator->get('product_detail_view_product_id')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getArticleID()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_brand')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getArticleBrand()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_category')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getArticleCategory()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_subcategory')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getArticleSubCategory()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_color')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getColor()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_size')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getSize()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_material')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getArticleMaterial()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_weight')?></div><div class="attr-value"><?= ViewHelper::e($artikel->getWeight()) . ' ' . ViewHelper::e($artikel->getWeightUnit()); ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_stock_quantity')?></div><div class="attr-value"><?= method_exists($artikel, 'getQuantityOfStock') ? ViewHelper::e($artikel->getQuantityOfStock()) : 'N.v.t.'; ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_price')?></div><div class="attr-value"><?= method_exists($artikel, 'getPrice') ? '€' . number_format($artikel->getPrice(), 2, ',', '.') : 'N.v.t.'; ?></div></li>
            <li><div class="attr-label"><?= $translator->get('product_detail_view_availability')?></div><div class="attr-value"><?= $artikel->getArticleAvailability() ? 'Ja' : 'Nee'; ?></div></li>
        </ul>
        <a href="productpagina.php" class="back-link"><?= $translator->get('product_detail_view_back_link') ?></a>
        </div>
    </div>
</main>

<footer></footer>

<script src="js/scripts.js"></script>
<script>
    includeHTML("header.php", "header");
    includeHTML("footer.php", "footer");
</script>



</body>
</html>
