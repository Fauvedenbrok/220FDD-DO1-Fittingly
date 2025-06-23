<?php
/**
 * settings.php
 *
 * Admin settings page for Fittingly.
 * - Secures the page for admin access only.
 * - Loads the translator for multilingual support.
 * - Intended for updating admin or partner information.
 * - Placeholder for additional admin portal navigation and settings options.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 */

require_once __DIR__ . '/auth_admin.php';
require_once __DIR__ . '/../../public_html/Lang/Translator.php';

$translator = init_translator();


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
    <!--
    /**
     * Main content for the admin settings page.
     * Placeholder for extra navigation and admin/partner settings options.
     * @var object $translator Used for multilingual content.
     */
    -->
  </main>
  <footer>
  </footer>

  <script src="/public_html/js/scripts.js"></script>
  <script>
    // Includes the admin header HTML into the <header> element
    includeHTML("/project_root/admin/adminheader.php", "header");
  </script>
</body>

</html>