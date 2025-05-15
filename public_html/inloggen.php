<?php
session_start();
// Als er een taal gekozen is via de URL (bijvoorbeeld ?lang=nl of ?lang=en)
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];  // Sla de gekozen taal op in de sessie
}

// Als er geen taal is gekozen, gebruik dan de default taal 'nl'
$lang = $_SESSION['lang'] ?? 'nl';

// Laad het juiste taalbestand
include "lang/$lang.php";

require_once '../project_root/includes/login/login_view.inc.php';

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title> <?= $inlogpagina_title_text?> </title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact"> <?= $inlogpagina_header_text ?> </h2>
            <p id="para-contact"> <?= $inlogpagina_paragraph_text ?> </p>
        </div>

        <div class="form-container">
            <div class="contact-info">

            </div>
            <form method="post" action="../project_root/includes/login/login.inc.php">
                <label for="email">
                    <?= $inlogpagina_formulier_email?>
                    <input type="text" name="EmailAddress" placeholder="<?= $inlogpagina_formulier_email_placeholder?> "><br>
                </label>
                <label for="password">
                    <?= $inlogpagina_formulier_password?>
                    <input type="password" name="UserPassword" placeholder="<?= $inlogpagina_formulier_password_placeholder?> "><br>
                </label>
                <label>
                    <button><?= $inlogpagina_formulier_button?> </button>
                </label>
                <?php 
                    check_login_errors();
                ?>
            </form>
        </div>
    </main>
    <footer>
    </footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer");
    </script>
</body>

</html>