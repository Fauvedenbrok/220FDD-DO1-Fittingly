<?php
/**
 * product_list_view.php
 *
 * View for displaying a list of products to the customer.
 * - Shows a search form for filtering by keyword and category.
 * - Displays a grid of product cards with image, name, availability, and detail link.
 * - Allows logged-in users to add products to the cart.
 * - Shows a popup when a product is added to the cart.
 * - Uses ViewHelper for safe HTML output and Translator for multilingual support.
 *
 * Variables:
 * @var array $artikelen      List of article objects to display.
 * @var string $zoekwoord     The current search keyword (from GET).
 * @var string $categorie     The selected category (from GET).
 * @var object $translator    Translator object for multilingual labels.
 */

use Helpers\ViewHelper;
use Core\Session;

require_once __DIR__ . '/../../project_root/Helpers/ViewHelper.php';
require_once __DIR__ . '/../../project_root/Core/Session.php';



?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title><?= $translator->get('product_list_view_customer_title') ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/product.css">
</head>

<body>

    <header></header>

    <div class="product-overview-container">
        <h2>Fittingly Wardrobe</h2>

        <div id="cart-popup" class="popup hidden">
            <?= $translator->get('product_list_view_customer_popup') ?>
        </div>
        <!--
        /**
         * Search form for filtering by keyword and category.
         * @form Method: GET — sends search data via URL to productpagina.php.
         * @input Search field with value filled via ViewHelper::e().
         * @select Dropdown for categories with 'selected' on active filter.
         * @button Submits the form (search).
         */
        -->
        <form method="get" action="productpagina.php" class="search-form">
            <input type="text" name="zoekwoord" placeholder=" <?= $translator->get('product_list_view_customer_search_placeholder') ?>" value="<?= ViewHelper::e($zoekwoord); ?>">

            <select name="categorie">
                <option value=""> <?= $translator->get('product_list_view_customer_category_all') ?></option>
                <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_customer_category_men') ?></option>
                <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_customer_category_women') ?></option>
                <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>><?= $translator->get('product_list_view_customer_category_accessories') ?></option>
            </select>

            <button type="submit"><?= $translator->get('product_list_view_customer_search_button') ?></button>
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

                    <?php if ($artikel->imageExists()): ?>
                        <img src="<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= ViewHelper::e($artikel->getArticleName()); ?>">
                    <?php else: ?>
                        <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                    <?php endif; ?>

                    <p><?= $artikel->getArticleAvailability() ? $translator->get('product_list_view_customer_availability_in_stock') : $translator->get('product_list_view_customer_availability_out_of_stock'); ?></p>

                    <?php if (Session::exists('user_email')): ?>
                        <!--
                        /**
                         * Add-to-cart form for logged-in users.
                         * @form Submits product ID and quantity to cart.php.
                         * @button Disabled if not in stock.
                         */
                        -->
                        <form method="post" action="../public_html/cart.php" class="add-to-cart-form">
                            <input type="hidden" name="product_id" value="<?= ViewHelper::e($artikel->getArticleID()); ?>">
                            <label for="quantity_<?= ViewHelper::e($artikel->getArticleID()); ?>"><?= $translator->get('product_list_view_customer_quantity') ?></label>
                            <input
                                type="number"
                                id="quantity_<?= ViewHelper::e($artikel->getArticleID()); ?>"
                                name="quantity"
                                value="1"
                                min="1" max="99"
                                required>
                            <button type="submit" name="add_to_cart"
                                <?= !$artikel->getArticleAvailability() ? 'disabled title="Niet op voorraad"' : '' ?>
                                class="add-to-cart-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </button>
                        </form>
                    <?php else: ?>
                        <!--
                        /**
                         * Button for guests to prompt login before adding to cart.
                         */
                        -->
                        <button type="button" onclick="window.location.href='inloggen.php'" class="add-to-cart-button detail-button" style="display:inline-block;text-align:center;">
                            <?= $translator->get('product_list_view_customer_cart_login_first') ?? 'Log in om toe te voegen aan winkelmand' ?>
                        </button>
                    <?php endif; ?>
                    </button>

                    </form>

                    <a href="product.php?id=<?= ViewHelper::e($artikel->getArticleID()); ?>" class="detail-button"><?= $translator->get('product_list_view_customer_detail_button') ?></a>

                    <a href="cart.php" class="cart-link">
                        <?= $translator->get('product_list_view_customer_cart_link'); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer></footer>

    <script src="js/cart-popup.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer");
    </script>

</body>

</html>