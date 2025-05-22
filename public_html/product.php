<?php
use Core\Database;
require_once 'Lang/translator.php';
$translator = init_translator();

require_once __DIR__ . '/../project_root/Core/Database.php';
require_once __DIR__ . '/../project_root/repositories/ArticlesRepository.php';

$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

$id = (int) ($_GET['id'] ?? 0);
$artikel = $articlesRepo->findById($id);

if (!$artikel) {
    echo "Artikel niet gevonden.";
    exit;
}

$categorieClass = strtolower(str_replace(' ', '-', $artikel->getArticleCategory()));
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($artikel->getArticleName()); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header></header>
<div class="product-detail <?php echo $categorieClass; ?>">
    <h1><?php echo htmlspecialchars($artikel->getArticleName()); ?></h1>

    <?php if (!empty($artikel->getArticleImagePath())): ?>
        <img src="uploads/<?php echo htmlspecialchars($artikel->getArticleImagePath()); ?>" alt="<?php echo htmlspecialchars($artikel->getArticleName()); ?>" class="product-image">
    <?php else: ?>
        <img src="uploads/default.jpg" alt="Geen afbeelding beschikbaar" class="product-image">
    <?php endif; ?>

    <p><strong>Categorie:</strong> <?php echo htmlspecialchars($artikel->getArticleCategory()); ?></p>
    <p><strong>Subcategorie:</strong> <?php echo htmlspecialchars($artikel->getArticleSubCategory()); ?></p>
    <p><strong>Kleur:</strong> <?php echo htmlspecialchars($artikel->getColor()); ?></p>
    <p><strong>Materiaal:</strong> <?php echo htmlspecialchars($artikel->getArticleMaterial()); ?></p>
    <p><strong>Gewicht:</strong> <?php echo htmlspecialchars($artikel->getWeight() . ' ' . $artikel->getWeightUnit()); ?></p>
    <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($artikel->getArticleDescription()); ?></p>
    <p><strong>Merk:</strong> <?php echo htmlspecialchars($artikel->getArticleBrand()); ?></p>

    <a href="productpagina.php" class="back-link">← Terug naar overzicht</a>
</div>
<footer></footer>
<script src="js/scripts.js"></script>
<script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer")
</script>
</body>
</html>
