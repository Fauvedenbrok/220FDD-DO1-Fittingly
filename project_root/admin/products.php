<?php
session_start();
require_once __DIR__ . '/../../public_html/Lang/translator.php';
// filepath: c:\Users\Richard\Documents\School Avans\Jaar 1\Projecten\220FDD-DO1-Fittingly\project_root\admin\adminportal.php
// Haal de taal uit de sessie (standaard 'nl' als niet ingesteld)
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';
// Laad het juiste taalbestand

$translator = new Translator($lang);

if(isset($_GET['upload'])) {
    // Hier kan je de upload status controleren
    if($_GET['upload'] == "success") {
        echo "<script>alert('Upload succesvol!');</script>";
    } elseif($_GET['upload'] == "error") {
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

<body style="background-image: url('/public_html/Images/onsdoelImages/background_dark.png');">
  <header>
  </header>
  
  <main class="main-content">
  <!-- extra navigatie voor opties admin portal 
   // producten, orders, berichten, retouren, klanten, instellingen-->

    
    <form action="includes/upload/csv-product_upload_control.php" method="post" enctype="multipart/form-data">
    Selecteer CSV-bestand:
    <input type="file" name="csv_file" accept=".csv">
    <input type="submit" name="upload" value="Uploaden">
    </form>
    <form action="includes/download/csv-product-download-controller.php">
      <input type="submit" name="download" value="Download CSV">
    </form>
  </main>
  <footer>
  </footer>
  <script src="/public_html/js/scripts.js"></script>
  <script>
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>
</body>

</html>