<?php
/**
 * product_list_view.php
 *
 * View for displaying a list of products (admin overview).
 * - Shows a search form for filtering by keyword and category.
 * - Displays a grid of product cards with image, name, availability, and detail link.
 * - Uses ViewHelper for safe HTML output and Translator for multilingual support.
 *
 * Variables:
 * @var array $artikelen      List of article objects to display.
 * @var string $zoekwoord     The current search keyword (from GET).
 * @var string $categorie     The selected category (from GET).
 * @var object $translator    Translator object for multilingual labels.
 */
require_once __DIR__ . '/../../../project_root/Helpers/ViewHelper.php';
require_once __DIR__ . '/../../../public_html/Lang/Translator.php';
$translator = init_translator();

use Helpers\ViewHelper;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title><?= $translator->get('product_list_view_admin_partner_title') ?></title>
    <link rel="stylesheet" href="../../public_html/css/styles.css">
    <link rel="stylesheet" href="../../public_html/css/product.css">

</head>

<body>

    <header></header>
    <!--
    /**
     * Main container for the product overview page.
     * @div Contains the title, search form, and product grid.
     */
    -->
    <div class="product-overview-container">
        <h2>Fittingly Wardrobe</h2>
        <!--
        /**
         * Search form for filtering by keyword and category.
         * @form Method: GET — sends search data via URL to the same page.
         * @action Secured with htmlspecialchars to prevent XSS.
         * @input Search field with value filled via ViewHelper::e().
         * @select Dropdown for categories with 'selected' on active filter.
         * @button Submits the form (search).
         */
        -->
        <form method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="search-form">
            <input type="text" name="zoekwoord" placeholder="<?= $translator->get('product_list_view_admin_partner_search_placeholder') ?>" value="<?= ViewHelper::e($zoekwoord); ?>">

            <select name="categorie">
                <option value=""><?= $translator->get('product_list_view_admin_partner_category_all') ?></option>
                <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>> <?= $translator->get('product_list_view_admin_partner_category_men') ?></option>
                <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_admin_partner_category_women') ?></option>
                <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>> <?= $translator->get('product_list_view_admin_partner_category_accessoires') ?></option>
            </select>

            <button type="submit"><?= $translator->get('product_list_view_admin_partner_search_button') ?></button>
        </form>
        <!--
        /**
         * Grid with all products (articles).
         * @foreach Loops through each `$artikel` in the `$artikelen` list.
         * @ViewHelper::e() Used for XSS-safe output.
         */
        -->
        <div class="product-grid">
            <?php foreach ($artikelen as $artikel): ?>
                <div class="product-card">
                    <h3><?= ViewHelper::e($artikel->getArticleName()); ?></h3>
                    <!--
                    /**
                     * Loads article image if it exists, otherwise shows a placeholder.
                     */
                    -->
                    <?php if ($artikel->imageExists()): ?>
                        <img src="../../public_html/<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= ViewHelper::e($artikel->getArticleName()); ?>">
                    <?php else: ?>
                        <img src="../../public_html/Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                    <?php endif; ?>
                    <p><?= $artikel->getArticleAvailability() ? $translator->get('product_list_view_admin_partner_availability_in_stock') : $translator->get('product_list_view_admin_partner_availability_out_of_stock'); ?></p>
                    <!--
                    /**
                     * Button to go to the product detail page with the article ID.
                     */
                    -->
                    <a href="product.php?id=<?= ViewHelper::e($artikel->getArticleID()); ?>" class="detail-button"><?= $translator->get('product_list_view_admin_partner_detail_button') ?></a>
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