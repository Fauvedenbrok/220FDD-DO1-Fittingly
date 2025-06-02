<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

require_once __DIR__ . '/../Controllers/admin_searchwords_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_word'])) {
  deleteSearchWord($_POST['delete_word']);
  // Optional: header('Location: admin_searchwords.php'); exit; // to refresh the page
}
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
</head>

<body style="background-image: url('../Images/onsdoelImages/background_dark.png');">
  <header>
  </header>

  <main class="main-content">
    <!-- Table waar de zoekwoorden worden weergegeven vanuit de database -->
    <div class="search-words-table">
      <h2><?php echo $translator->get('admin_searchwords_title'); ?></h2>
      <table id="admin-table">
        <thead>
          <tr>
            <th class="admin-table-header"><?php echo $translator->get('admin_searchwords_column_word'); ?></th>
            <th class="admin-table-header"><?php echo $translator->get('admin_searchwords_column_count'); ?></th>
            <th class="admin-table-header"><?php echo $translator->get('admin_searchwords_column_delete'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $searchWords = getSearchWords();

          // Loop door de zoekwoorden en voeg ze toe aan de tabel
          foreach ($searchWords as $word): ?>
            <tr>
              <td class="admin-table-data"><?= htmlspecialchars($word['SearchWord']) ?></td>
              <td class="admin-table-data"><?= htmlspecialchars($word['Count']) ?></td>
              <td class="admin-table-data">
                <form method="post" action="">
                  <input type="hidden" name="delete_word" value="<?= htmlspecialchars($word['SearchWord']) ?>">
                  <button type="submit" onclick="return confirm('Weet je zeker dat je dit zoekwoord wilt verwijderen?')"><?= $translator->get('admin_searchwords_column_delete') ?></button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>

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