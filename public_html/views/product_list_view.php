<?php
use Helpers\ViewHelper;


require_once __DIR__ . '/../../project_root/Helpers/ViewHelper.php';




?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Productpagina</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/product.css">

</head>

<body>

    <header></header>

    <div class="product-overview-container">
        <h2>Fittingly Wardrobe</h2>

        <form method="get" action="productpagina.php" class="search-form">
            <input type="text" name="zoekwoord" placeholder=" <?= $translator->get('product_list_view_search_placeholder') ?>" value="<?= ViewHelper::e($zoekwoord); ?>">

            <select name="categorie">
                <option value=""> <?= $translator->get('product_list_view_category_all') ?></option>
                <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_category_men') ?></option>
                <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_category_women') ?></option>
                <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_category_accessories') ?></option>
            </select>

            <button type="submit"><?= $translator->get('product_list_view_search_button') ?></button>
        </form>

        <div class="product-grid">
            <?php foreach ($artikelen as $artikel): ?>
                <div class="product-card">
                    <h3><?= ViewHelper::e($artikel->getArticleName()); ?></h3>

                    <?php if ($artikel->imageExists()): ?>
                        <img src="<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= ViewHelper::e($artikel->getArticleName()); ?>">
                    <?php else: ?>
                        <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                    <?php endif; ?>

                    <p><?= $artikel->getArticleAvailability() ? $translator->get('product_list_view_availability_in_stock') : $translator->get('product_list_view_availability_out_of_stock'); ?></p>
                    <a href="product.php?id=<?= ViewHelper::e($artikel->getArticleID()); ?>" class="detail-button"><?= $translator->get('product_list_view_detail_button') ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer></footer>

    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer");
    </script>

</body>

</html>