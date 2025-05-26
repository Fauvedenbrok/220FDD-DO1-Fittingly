<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Productpagina</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header></header>

<div class="container">
    <h1>Onze Artikelen</h1>

    <form method="get" action="productpagina.php">
        <input type="text" name="zoekwoord" placeholder="Zoek artikelen..." value="<?= htmlspecialchars($zoekwoord); ?>">
        <select name="categorie">
            <option value="">Alle categorieën</option>
            <option value="Mannenkleding" <?= $categorie === 'Mannenkleding' ? 'selected' : ''; ?>>Mannenkleding</option>
            <option value="Vrouwenkleding" <?= $categorie === 'Vrouwenkleding' ? 'selected' : ''; ?>>Vrouwenkleding</option>
            <option value="Accessoires" <?= $categorie === 'Accessoires' ? 'selected' : ''; ?>>Accessoires</option>
        </select>
        <button type="submit">Zoek</button>
    </form>

    <div class="producten">
        <?php foreach ($artikelen as $artikel): ?>
            <div class="product">
                <h2><?= htmlspecialchars($artikel->getArticleName()); ?></h2>

                <?php if ($artikel->imageExists()): ?>
                    <img src="<?= $artikel->getImageUrl(); ?>" alt="Afbeelding van <?= htmlspecialchars($artikel->getArticleName()); ?>" style="max-width: 200px;">
                <?php else: ?>
                    <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
                <?php endif; ?>

                <p>Beschikbaar: <?= $artikel->getArticleAvailability() ? 'Ja' : 'Nee'; ?></p>
                <a href="product.php?id=<?= $artikel->getArticleID(); ?>">Bekijk product</a>
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
