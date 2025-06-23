<?php
/**
 * adminportal.php
 *
 * Admin portal homepage for Fittingly.
 * - Requires admin authentication.
 * - Loads the translator for multilingual support.
 * - Displays a welcome message and introduction for the admin.
 * - Includes the admin header and footer templates.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 */

require_once __DIR__ . '/../Lang/Translator.php';
require_once __DIR__ . '/auth_admin.php';

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
    <!--
    /**
     * Main content for the admin portal.
     * Displays welcome and introduction text for the admin.
     * @var object $translator Used for multilingual content.
     */
    -->
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
  // Includes the admin header HTML into the <header> element
  includeHTML("/public_html/admin/adminheader.php", "header");
</script>
</body>

</html>