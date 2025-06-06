<?php
require_once __DIR__ . '/../../../project_root/Helpers/ViewHelper.php';
/** ViewHelper verwerkt htmlspecialchars voor veilige HTML-uitvoer en minder herhaling (OOP) */
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
    /** Container voor de detailpagina van een product.
    * @class product-detail-container   Voor styling via CSS.
    * @?= $categorieClass; ?            Short echo van PHP-variabele die dynamisch een extra class toevoegt (bijv. "mannen", "vrouwen").
    * @categorieClass string            Wordt meestal bepaald aan de hand van de gekozen categorie.
    */
    -->
    <div class="product-detail-container <?= $categorieClass; ?>">
    <div class="product-detail-layout">
        <!--
        /** Toont afbeelding van product of een placeholder.
         * @if $artikel->imageExists()        Methode van object die checkt of er een afbeelding beschikbaar is (bool).
         * @getImageUrl()                     Methode die de URL van de afbeelding retourneert (string).
         * @getArticleName()                  Geeft productnaam terug voor alt-tekst.
         * @htmlspecialchars()                Escape functie om XSS in alt-tekst te voorkomen.
         * @artikel object                    Bevat alle informatie over 1 artikel.
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
        /** Formulier om een product te updaten als admin (POST).
        * @action string           Verwijst naar controller die de update uitvoert.
        * @method POST             Gegevens worden veilig verstuurd.
        * @enctype multipart/...   Nodig voor bestand (image) upload.
        */
        -->
        <form action="../../project_root/Controllers/product_update_controller.php" method="post" enctype="multipart/form-data">
        <!--
        /** Lijst met attributen van het product. Elk <li> bevat één regel.
        * @ul.product-attributes      Layout-class voor styling.
        * @type hidden                Niet zichtbaar in user interface.
        * @name="productID"           Formulier-naam.
        * @getArticleX()              Verschillende methodes die artikelinfo ophalen: naam, beschrijving, merk, etc.
        * @method_exists()            Alleen uitvoeren als methode (price) bestaat.
        * @getQuantityOfStock()       Methode die voorraad teruggeeft (int)
        * @'N.v.t.'                   Wordt getoond als methode (price) niet beschikbaar is.
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
            /** Inputveld voor het uploaden van een afbeelding (admin).
            * @type file               Nodig voor bestandsselectie.
            * @name imagePath          Key voor verwerking in controller.
            * @accept="image/*"        Beperk bestandstypes tot afbeeldingen.
            */
            -->
            <li><label for="file">Upload afbeelding:</label>
            <input type="file" name="imagePath" id="file" accept="image/*"></li>

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
