<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

require_once '../../project_root/Controllers/admin_searchwords_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_word'])) {
  deleteSearchWord($_POST['delete_word']);
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
    <!-- Table waar de zoekwoorden worden weergegeven vanuit de database -->
    <div class="search-words-table">
      <h2><?php echo $translator->get('admin_searchwords_title'); ?></h2>
      <table id="admin-table">
        <thead>
          <tr>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_word'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_count'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_delete'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_match'); ?></th>
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
                <?php if (searchWordExists($word['SearchWord'])): ?>
                  <span class="match"><?= $translator->get('admin_searchwords_match_yes') ?></span>
                <?php else: ?>
                  <span class="no-match"><?= $translator->get('admin_searchwords_match_no') ?></span>
                <?php endif; ?>
              </td>
              <td class="admin-table-data">
                <form method="post" action="">
                  <input type="hidden" name="delete_word" value="<?= htmlspecialchars($word['SearchWord']) ?>">
                  <button type="submit" onclick="return confirm('<?= $translator->get('admin_searchwords_delete_confirmation') ?>')"><?= $translator->get('admin_searchwords_column_delete') ?></button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>

  </main>

  <footer>
  </footer>

  <script src="../../public_html/js/scripts.js"></script>
  <script>
    includeHTML("../../public_html/admin/adminheader.php", "header");
  </script>
</body>

</html>