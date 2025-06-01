<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

if (isset($_GET['upload'])) {
  // Hier kan je de upload status controleren
  if ($_GET['upload'] == "success") {
    echo "<script>alert('Upload succesvol!');</script>";
  } elseif ($_GET['upload'] == "error") {
    echo "<script>alert('Upload mislukt!');</script>";
  }
}

// login check en rechten

// afbeelding upload

// producten aanpassen
// producten toevoegen
// producten verwijderen


?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fittingly</title>
  <link rel="icon" href="../Images/icons/favicon.ico">
  <link rel="stylesheet" href="/public_html/css/adminstyles.css">
  <link rel="stylesheet" href="/public_html/css/styles.css">
</head>

<body>
  <header>
  </header>

  <main class="main-content">
    <!-- extra navigatie voor opties admin portal 
   // producten, orders, berichten, retouren, klanten, instellingen-->


    <form action="includes/upload/csv-product_upload_control.php" method="post" enctype="multipart/form-data">
      <?= $translator->get('admin_products_upload_csv_label') ?>
      <input type="file" name="csv_file" accept=".csv">
      <button type="submit" name="upload"><?= $translator->get('admin_products_upload_button') ?></button>
    </form>
    <form action="includes/download/csv-product-download-controller.php" method="post">
      <button type="submit" name="download"><?= $translator->get('admin_products_download_csv') ?></button>
    </form>
    <?php
    $data = require_once '../Controllers/product_list_controller.php';

    // Extraheer de variabelen uit de controller naar losse variabelen
    extract($data);

    // Laad de view (HTML weergave)
    require_once 'views/product_list_view.php';
    ?>
  </main>
  <footer>
  </footer>
  <script src="/public_html/js/scripts.js"></script>
  <script>
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>
</body>

</html>