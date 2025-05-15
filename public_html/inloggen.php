<?php
session_start();
require_once 'Lang/translator.php';

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';

$translator = new Translator($lang);
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title> <?= $translator-> get('inlogpagina_title_text') ?> </title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact"> <?= $translator-> get('inlogpagina_header_text') ?> </h2>
            <p id="para-contact"> <?= $translator-> get('inlogpagina_paragraph_text') ?> </p>
        </div>

        <div class="form-container" style="margin: -10vh auto 0 auto;">
            <div class="contact-info">

            </div>
            <form method="post" action="../project_root/includes/login/login.inc.php">
                <label for="email">
                    <?= $translator-> get('inlogpagina_formulier_email') ?>
                    <input type="text" name="EmailAddress" placeholder="<?= $translator-> get('inlogpagina_formulier_email_placeholder') ?> "><br>
                </label>
                <label for="password">
                    <?= $translator-> get('inlogpagina_formulier_password') ?>
                    <input type="password" name="UserPassword" placeholder="<?= $translator-> get('inlogpagina_formulier_password_placeholder') ?> "><br>
                </label>
                <label>
                    <button><?= $translator-> get('inlogpagina_formulier_button') ?> </button>
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