<?php

use Core\Database;
use Repositories\ArticlesRepository;

session_start();
require_once 'Lang/translator.php';

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';

$translator = new Translator($lang);

require_once __DIR__ . '/../project_root/Core/Database.php';
require_once __DIR__ . '/../project_root/repositories/ArticlesRepository.php';

$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';

$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);
?>
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
        <input type="text" name="zoekwoord" placeholder="Zoek artikelen..." value="<?php echo htmlspecialchars($zoekwoord); ?>">
        <select name="categorie">
            <option value="">Alle categorieën</option>
            <option value="Mannenkleding" <?php if ($categorie === 'Mannenkleding') echo 'selected'; ?>>Mannenkleding</option>
            <option value="Vrouwenkleding" <?php if ($categorie === 'Vrouwenkleding') echo 'selected'; ?>>Vrouwenkleding</option>
            <option value="Accessoires" <?php if ($categorie === 'Accessoires') echo 'selected'; ?>>Accessoires</option>
        </select>
        <button type="submit">Zoek</button>
    </form>

    <div class="producten">
    <?php foreach ($artikelen as $artikel): ?>
        <div class="product">
            <h2><?php echo htmlspecialchars($artikel->getArticleName()); ?></h2>

            <?php if ($artikel->imageExists()): ?>
                <img src="<?php echo $artikel->getImageUrl(); ?>" alt="Afbeelding van <?php echo htmlspecialchars($artikel->getArticleName()); ?>"style="max-width: 200px;">
            <?php else: ?>
                <img src="Images/placeholder.jpg" alt="Geen afbeelding beschikbaar">
            <?php endif; ?>

            <p>Beschikbaar: <?php echo $artikel->getArticleAvailability() ? 'Ja' : 'Nee'; ?></p>
            <a href="product.php?id=<?php echo $artikel->getArticleID(); ?>">Bekijk product</a>
        </div>
    <?php endforeach; ?>
</div>

</div>
<footer></footer>
<script src="js/scripts.js"></script>
<script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer")
</script>
</body>
</html>
