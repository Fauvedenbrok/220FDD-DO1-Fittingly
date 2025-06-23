<?php
/**
 * admin_searchwords.php
 *
 * Admin page for managing and viewing search words used on the platform.
 * - Requires admin authentication.
 * - Loads the translator for multilingual support.
 * - Loads the controller for search word management.
 * - Handles POST requests to delete search words.
 * - Displays a table of search words, their usage count, and match status.
 *
 * Functions used:
 * - getSearchWords(): Retrieves all search words from the database.
 * - deleteSearchWord(string $word): Deletes a search word from the database.
 * - searchWordExists(string $word): Checks if a search word exists in the database.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 * @var array $searchWords List of search words with their count and match status.
 */

require_once __DIR__ . '/auth_admin.php';
require_once __DIR__ . '/../../public_html/Lang/Translator.php';

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
    <!-- 
    /**
     * Table displaying search words from the database.
     * @var array $searchWords List of search words.
     * @var object $translator Translator for column headers and labels.
     */
    -->
    <div class="search-words-table">
      <h2><?php echo $translator->get('admin_searchwords_title'); ?></h2>
      <table id="admin-table">
        <thead>
          <tr>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_word'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_count'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_match'); ?></th>
            <th class="admin-table-header"><?= $translator->get('admin_searchwords_column_delete'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $searchWords = getSearchWords();

          // Loop through the search words and add them to the table
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