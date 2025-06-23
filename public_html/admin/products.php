<?php
/**
 * products.php
 *
 * Admin product management page for Fittingly.
 * - Secures the page for admin access only.
 * - Loads the translator for multilingual support.
 * - Handles CSV upload and download for product data.
 * - Loads the product list controller and passes data to the view.
 * - Displays upload status alerts.
 *
 * Variables:
 * @var object $translator Translator object for multi-language support.
 * @var array $data        Data array returned from the product_list_controller.
 */

require_once __DIR__ . '/auth_admin.php';
require_once __DIR__ . '/../Lang/Translator.php';

/**
 * @var object $translator Translator object for multi-language support.
 */
$translator = init_translator();

/**
 * Show upload status alerts based on the 'upload' GET parameter.
 */
if (isset($_GET['upload'])) {
  // Check the upload status and show an alert
  if ($_GET['upload'] == "success") {
    echo "<script>alert('Upload succesvol!');</script>";
  } elseif ($_GET['upload'] == "error") {
    echo "<script>alert('Upload mislukt!');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fittingly</title>
  <link rel="icon" href="../Images/icons/favicon.ico">
  <link rel="stylesheet" href="/public_html/css/styles.css">
</head>

<body>
  <header>
  </header>
  <main class="main-content">
    <div id="CSV-upload-download-form">
      <!--
      CSV upload form for products.
      @form Uploads a CSV file to the server for product import.
    -->
      <form action="../../project_root/Controllers/csv-product_upload_control.php" method="post" enctype="multipart/form-data">
        <?= $translator->get('admin_products_upload_csv_label') ?>
        <input type="file" name="csv_file" accept=".csv">
        <button type="submit" name="upload"><?= $translator->get('admin_products_upload_button') ?></button>
      </form>
      <!--
      CSV download form for products.
      @form Downloads all products as a CSV file.
      -->
      <form action="../../project_root/Controllers/csv-product-download-controller.php" method="post">
        <button type="submit" name="download"><?= $translator->get('admin_products_download_csv') ?></button>
      </form>
    </div>
    <?php
    /**
     * Load the product list controller and extract its data for the view.
     * @var array $data Data returned from the controller.
     */
    $data = require_once '../../project_root/Controllers/product_list_controller.php';

    // Extract the variables from the controller data array
    extract($data);

    // Load the view (HTML display)
    require_once 'views/product_list_view.php';
    ?>
  </main>
  <footer>
  </footer>
  <script src="/public_html/js/scripts.js"></script>
  <script>
    // Includes the admin header HTML into the <header> element
    includeHTML("adminheader.php", "header");
  </script>
</body>

</html>