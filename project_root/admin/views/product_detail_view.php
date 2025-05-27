<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($artikel->getArticleName()); ?></title>
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
            <h2><?= htmlspecialchars($artikel->getArticleName()); ?></h2>
            <p class="product-description"><?= nl2br(htmlspecialchars($artikel->getArticleDescription())); ?></p>

            <div class="product-attributes">
                <p><strong>Merk:</strong> <?= htmlspecialchars($artikel->getArticleBrand()); ?></p>
                <p><strong>Categorie:</strong> <?= htmlspecialchars($artikel->getArticleCategory()); ?></p>
                <p><strong>Subcategorie:</strong> <?= htmlspecialchars($artikel->getArticleSubCategory()); ?></p>
                <p><strong>Kleur:</strong> <?= htmlspecialchars($artikel->getColor()); ?></p>
                <p><strong>Maat:</strong> <?= htmlspecialchars($artikel->getSize()); ?></p>
                <p><strong>Materiaal:</strong> <?= htmlspecialchars($artikel->getArticleMaterial()); ?></p>
                <p><strong>Gewicht:</strong> <?= htmlspecialchars($artikel->getWeight()) . ' ' . $artikel->getWeightUnit(); ?></p>
                <p><strong>Voorraad:</strong> <?= method_exists($artikel, 'getQuantityOfStock') ? $artikel->getQuantityOfStock() : 'N.v.t.'; ?></p>
                <p><strong>Prijs:</strong> <?= method_exists($artikel, 'getPrice') ? '€' . number_format($artikel->getPrice(), 2, ',', '.') : 'N.v.t.'; ?></p>
                <p><strong>Beschikbaar:</strong> <?= $artikel->getArticleAvailability() ? 'Ja' : 'Nee'; ?></p>
            </div>
        </div>
    </div>

    <a href="productpagina.php" class="back-link">← Terug naar overzicht</a>
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
