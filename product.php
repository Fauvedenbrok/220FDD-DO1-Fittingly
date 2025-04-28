<?php
require 'db_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE ArticleID = :id");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();
}

if (!$product) {
    echo "Artikel niet gevonden.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['Name']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($product['Name']); ?></h1>
    <p><strong>Prijs:</strong> (prijs ontbreekt in tabel, maar je kunt gewicht tonen!)</p>
    <p><strong>Gewicht:</strong> <?php echo $product['Weight'] . ' ' . $product['WeightUnit']; ?></p>
    <p><strong>Categorie:</strong> <?php echo htmlspecialchars($product['Category']); ?></p>
    <p><strong>Subcategorie:</strong> <?php echo htmlspecialchars($product['SubCategory']); ?></p>
    <p><strong>Materiaal:</strong> <?php echo htmlspecialchars($product['Material']); ?></p>
    <p><strong>Kleur:</strong> <?php echo htmlspecialchars($product['Color']); ?></p>
    <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($product['Description']); ?></p>
    <p><strong>Merk:</strong> <?php echo htmlspecialchars($product['Brand']); ?></p>

    <a href="productpagina.php">← Terug naar artikelen</a>
</div>

</body>
</html>
