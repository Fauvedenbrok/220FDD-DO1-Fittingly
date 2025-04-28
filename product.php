<?php
require_once 'db_connect.php';
require_once 'repositories/ArticlesRepository.php';

$db = new Database();
$pdo = $db->getPdo();
$articlesRepo = new ArticlesRepository($pdo);

$id = (int) ($_GET['id'] ?? 0);
$article = $articlesRepo->findById($id);

if (!$article) {
    echo "Artikel niet gevonden.";
    exit;
}

$categorieClass = strtolower(str_replace(' ', '-', $article->category));
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article->name); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="product-detail <?php echo $categorieClass; ?>">
    <h1><?php echo htmlspecialchars($article->name); ?></h1>

    <?php if (!empty($article->image)): ?>
        <img src="uploads/<?php echo htmlspecialchars($article->image); ?>" alt="<?php echo htmlspecialchars($article->name); ?>" class="product-image">
    <?php else: ?>
        <img src="uploads/default.jpg" alt="Standaard afbeelding" class="product-image">
    <?php endif; ?>

    <p><strong>Categorie:</strong> <?php echo htmlspecialchars($article->category); ?></p>
    <p><strong>Subcategorie:</strong> <?php echo htmlspecialchars($article->subcategory); ?></p>
    <p><strong>Kleur:</strong> <?php echo htmlspecialchars($article->color); ?></p>
    <p><strong>Materiaal:</strong> <?php echo htmlspecialchars($article->material); ?></p>
    <p><strong>Gewicht:</strong> <?php echo htmlspecialchars($article->weight . ' ' . $article->weightUnit); ?></p>
    <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($article->description); ?></p>
    <p><strong>Merk:</strong> <?php echo htmlspecialchars($article->brand); ?></p>

    <a href="productpagina.php" class="back-link">← Terug naar artikelen</a>
</div>

</body>
</html>
