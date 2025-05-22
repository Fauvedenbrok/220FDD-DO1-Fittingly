<?php

require_once 'Lang/translator.php';

$translator = init_translator();

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/registration_login.css">
    <title> <?= $translator->get('inlogpagina_title_text') ?> </title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 class="h2-registration-login"> <?= $translator->get('inlogpagina_header_text') ?> </h2>
            <p class="p-registration-login"> <?= $translator->get('inlogpagina_paragraph_text') ?> </p>


            <div class="registration-login-form-container">

                <form method="post" action="../project_root/includes/login/login.inc.php">
                    <label for="email">
                        <?= $translator->get('inlogpagina_formulier_email') ?>
                        <input type="text" name="EmailAddress" placeholder="<?= $translator->get('inlogpagina_formulier_email_placeholder') ?> "><br>
                    </label>
                    <label for="password">
                        <?= $translator->get('inlogpagina_formulier_password') ?>
                        <input type="password" name="UserPassword" placeholder="<?= $translator->get('inlogpagina_formulier_password_placeholder') ?> "><br>
                    </label>
                    <label>
                        <button><?= $translator->get('inlogpagina_formulier_button') ?> </button>
                    </label>
                </form>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer")
    </script>

</body>

</html>