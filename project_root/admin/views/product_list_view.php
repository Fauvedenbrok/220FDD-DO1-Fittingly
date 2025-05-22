<?php


// echo een lijst met minimale product informatie
// product afbeelding zal kleiner zijn
// product naam
// product prijs
// voorraad
// availability
// product id
foreach($articlesArray as $article) {
    $productId = $article->getArticleID();
    $title = $article->getArticleName();
    $price = $article->getPrice();
    $stock = $article->getQuantityOfStock();
    $availability = $article->getArticleAvailability();
    $afbeelding = "<img src='{$article->getArticleImagePath()}' alt='{$title}' style='width: 100px; height: auto;'>";

    // Hier kan je de HTML genereren voor elk product
    echo "
<div>$afbeelding</div>
<div>$title</div>
<div>$price</div>
<div>$stock</div>
<div>$availability</div>
<div>$productId</div>
";
    // Hier kan je ook een link toevoegen naar de product detail pagina
    echo "<a href='product_view.php?productId=$productId'>Bekijk product</a>";
}
