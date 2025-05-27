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
        <input type="text" name="zoekwoord" placeholder="Zoek artikelen..." value="<?= htmlspecialchars($zoekwoord); ?>">
        
        <select name="categorie">
            <option value="">Alle categorieën</option>
            <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>>Mannenkleding</option>
            <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>>Vrouwenkleding</option>
            <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>>Accessoires</option>
        </select>

        <button type="submit">Zoek</button>
    </form>

    <div class="product-grid">
        <?php foreach ($artikelen as $artikel): ?>
            <div class="product-card">
                <h3><?= htmlspecialchars($artikel->getArticleName()); ?></h3>

                <?php if ($artikel->imageExists()): ?>
                    <img src="<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($artikel->getArticleName()); ?>">
                <?php else: ?>
                    <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                <?php endif; ?>

                <p><?= $artikel->getArticleAvailability() ? 'Op voorraad' : 'Niet beschikbaar'; ?></p>
                <a href="product.php?id=<?= $artikel->getArticleID(); ?>" class="detail-button">Bekijk product</a>
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
