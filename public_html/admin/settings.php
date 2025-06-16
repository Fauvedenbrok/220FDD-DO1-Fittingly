<?php

require_once __DIR__ . '/auth_admin.php';
require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();


// login check en rechten check

// admin gegevens bijwerken / partner

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



  </main>
  <footer>
  </footer>

  <script src="/public_html/js/scripts.js"></script>
  <script>
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>
</body>

</html>