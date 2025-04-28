<?php
require_once 'db_connect.php';
require_once 'repositories/ArticlesRepository.php';

$db = new Database();
$pdo = $db->getPdo();
$articlesRepo = new ArticlesRepository($pdo);

$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';

$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Onze Artikelen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Onze Artikelen</h1>

    <form method="get" action="productpagina.php">
        <input type="text" name="zoekwoord" placeholder="Zoek artikelen..." value="<?php echo htmlspecialchars($zoekwoord); ?>">
        <select name="categorie">
            <option value="">Alle categorieën</option>
            <option value="Mannenkleding" <?php if ($categorie == 'Mannenkleding') echo 'selected'; ?>>Mannenkleding</option>
            <option value="Vrouwenkleding" <?php if ($categorie == 'Vrouwenkleding') echo 'selected'; ?>>Vrouwenkleding</option>
            <option value="Accessoires" <?php if ($categorie == 'Accessoires') echo 'selected'; ?>>Accessoires</option>
        </select>
        <button type="submit">Zoek</button>
    </form>

    <div class="producten">
        <?php foreach ($artikelen as $artikel): ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($artikel->name); ?></h2>
                <p>Beschikbaar: <?php echo $artikel->availability ? 'Ja' : 'Nee'; ?></p>
                <a href="product.php?id=<?php echo $artikel->id; ?>">Bekijk product</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
