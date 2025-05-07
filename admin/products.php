<?php
session_start();
// Als er een taal gekozen is via de URL (bijvoorbeeld ?lang=nl of ?lang=en)
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];  // Sla de gekozen taal op in de sessie
}

// Als er geen taal is gekozen, gebruik dan de default taal 'nl'
$lang = $_SESSION['lang'] ?? 'nl';

// Laad het juiste taalbestand
include "../lang/$lang.php";
?>
<?php



// login check en rechten check

// CSV download

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
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/adminstyles.css">
</head>

<body style="background-image: url('../Images/onsdoelImages/background_dark.png');">
  <header>
  </header>
  
  <main class="main-content">
  <!-- extra navigatie voor opties admin portal 
   // producten, orders, berichten, retouren, klanten, instellingen-->
  <nav class="admin-nav">
    <ul class="admin-nav-list">
      <li><a href="adminportal.php?lang=<?php echo $lang; ?>">Home</a></li>
      <li><a href="products.php?lang=<?php echo $lang; ?>">Producten</a></li>
      <li><a href="orders.php?lang=<?php echo $lang; ?>">Orders</a></li>
      <li><a href="messages.php?lang=<?php echo $lang; ?>">Berichten</a></li>
      <li><a href="returns.php?lang=<?php echo $lang; ?>">Retouren</a></li>
      <li><a href="customers.php?lang=<?php echo $lang; ?>">Klanten</a></li>
      <li><a href="settings.php?lang=<?php echo $lang; ?>">Instellingen</a></li>
      </ul>
  </nav>
    
    <form action="../includes/upload/csv-upload.php" method="post" enctype="multipart/form-data">
    Selecteer CSV-bestand:
    <input type="file" name="csv_file" accept=".csv">
    <input type="submit" name="upload" value="Uploaden">
    </form>
  </main>
  <footer>
  </footer>
  <script src="../js/scripts.js"></script>
  <script>
    includeHTML("../header.php", "header");
    includeHTML("../footer.php", "footer")
  </script>
</body>

</html>