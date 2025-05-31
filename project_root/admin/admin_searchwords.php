<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

require_once __DIR__ . '/../Controllers/admin_searchwords_controller.php';


// login check en rechten check


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

<body style="background-image: url('../Images/onsdoelImages/background_dark.png');">
  <header>
  </header>
  
  <main class="main-content">
    <!-- Table waar de zoekwoorden worden weergegeven vanuit de database -->
    <div class="search-words-table">
      <h2><?php echo $translator->get('admin_searchwords_title'); ?></h2>
      <table>
        <thead>
          <tr>
            <th><?php echo $translator->get('admin_searchwords_column_word'); ?></th>
            <th><?php echo $translator->get('admin_searchwords_column_count'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Laad de zoekwoorden uit de database

          $searchWords = getSearchWords();

          // Loop door de zoekwoorden en voeg ze toe aan de tabel
          foreach ($searchWords as $word) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($word['SearchWord']) . "</td>";
            echo "<td>" . htmlspecialchars($word['Count']) . "</td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
     


    

  </main>
  <footer>
  </footer>
  <script src="/public_html/js/scripts.js"></script>
  <script>
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>
</body>

</html>