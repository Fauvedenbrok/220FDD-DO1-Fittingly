<?php
require_once __DIR__ . '/../../../project_root/Helpers/ViewHelper.php';

/** ViewHelper verwerkt htmlspecialchars voor veilige HTML-uitvoer en minder herhaling (OOP) */
use Helpers\ViewHelper;
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Productpagina</title>
    <link rel="stylesheet" href="../../public_html/css/styles.css">
    <link rel="stylesheet" href="../../public_html/css/product.css">

</head>

<body>

    <header></header>
    <!--
    /** Hoofdcontainer voor de productoverzichtspagina.
     * @div Container voor titel, zoekformulier en productgrid.
     */
    -->
    <div class="product-overview-container">
        <h2>Fittingly Wardrobe</h2>
         <!--
        /** Zoekformulier voor filtering op zoekwoord en categorie.
         * @form Method: GET — stuurt zoekdata via URL naar dezelfde pagina.
         * @action Beveiligd met htmlspecialchars om XSS te voorkomen.
         * @input Zoekveld met ingevulde waarde via ViewHelper::e().
         * @select Dropdown voor categorieën met 'selected' op actieve filter.
         * @button Verzenden van formulier (zoeken).
         */
        -->
        <form method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="search-form">
            <input type="text" name="zoekwoord" placeholder="Zoek artikelen..." value="<?= ViewHelper::e($zoekwoord); ?>">

            <select name="categorie">
                <option value="">Alle categorieën</option>
                <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>>Mannenkleding</option>
                <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>>Vrouwenkleding</option>
                <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>>Accessoires</option>
            </select>

            <button type="submit">Zoek</button>
        </form>
        <!--
        /** Grid met alle producten (artikelen).
         * @foreach Loopt door elke `$artikel` in de `$artikelen` lijst.
         * @ViewHelper::e() Wordt gebruikt om XSS-veilige output te genereren.
         */
        -->
        <div class="product-grid">
            <?php foreach ($artikelen as $artikel): ?>
                <div class="product-card">
                    <h3><?= ViewHelper::e($artikel->getArticleName()); ?></h3>
                    <!--
                    /** Laadt afbeelding van artikel als die bestaat.*/
                    -->
                    <?php if ($artikel->imageExists()): ?>
                        <img src="../../public_html/<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= ViewHelper::e($artikel->getArticleName()); ?>">
                        <!--
                        /** Laadt placeholder als er geen afbeelding is.*/
                        -->
                        <?php else: ?>
                        <img src="../../public_html/Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                        <!--
                        /** Toont beschikbaarheid van artikel.*/
                        -->
                        <?php endif; ?>
                    <p><?= $artikel->getArticleAvailability() ? 'Op voorraad' : 'Niet beschikbaar'; ?></p>
                    <!--
                    /** Knop om naar product-detailpagina te gaan met ID.*/
                    -->
                    <a href="product.php?id=<?= ViewHelper::e($artikel->getArticleID()); ?>" class="detail-button">Bekijk product</a>
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