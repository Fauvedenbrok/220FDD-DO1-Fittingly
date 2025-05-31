<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

include 'adminheader.php'; // include admin header




// login check en rechten check


?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fittingly</title>
  <link rel="icon" href="../Images/icons/favicon.ico">

  <link rel="stylesheet" href="/public_html/css/styles.css">
  <link rel="stylesheet" href="/public_html/css/adminstyles.css">
</head>

<body style="background-image: url('../Images/onsdoelImages/background_dark.png');">
  <header>
  </header>

  <main class="main-content">
    <!-- extra navigatie voor opties admin portal 
   // producten, orders, berichten, retouren, klanten, instellingen-->

    <div>
      <h1>Admin Portal</h1>
      <p> <?= $translator-> get('adminportal_intro_1') ?> </p>
      <p> <?= $translator-> get('adminportal_intro_2') ?> </p>
      <p> <?= $translator-> get('adminportal_intro_3') ?> </p>
    </div>

  </main>
  <footer>
  </footer>
  <script src="/public_html/js/scripts.js"></script>
</body>

</html>