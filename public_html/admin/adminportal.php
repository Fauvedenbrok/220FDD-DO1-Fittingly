<?php

require_once __DIR__ . '/../Lang/translator.php';

$translator = init_translator();

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
    <!-- extra navigatie voor opties admin portal 
   // producten, orders, berichten, retouren, klanten, instellingen-->

    <div>
      <h1 id="welkomst_tekst_admin_h1"> <?= $translator->get('adminportal_welcome_title') ?></h1>
      <p class="admin-intro-text"> <?= $translator->get('adminportal_intro_1') ?> </p>
      <p class="admin-intro-text"> <?= $translator->get('adminportal_intro_2') ?> </p>
      <p class="admin-intro-text"> <?= $translator->get('adminportal_intro_3') ?> </p>
    </div>

  </main>

  <footer>
  </footer>
  
  <script src="../js/scripts.js"></script>

  <script>
includeHTML("/public_html/admin/adminheader.php", "header");
</script>
</body>

</html>