<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title>Klant registratie</title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact">Registratie</h2>
            <p id="para-contact">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore alias expedita eius! Ut enim fugiat eum pariatur non amet laudantium. Temporibus possimus non rerum exercitationem nesciunt officiis asperiores dolores impedit? </p>
        </div>

        <div class="form-container">
            <div class="contact-info">

            </div>
            <form method="post" action="inloggen.php">
                <label for="email">
                    E-mail:
                    <input type="email" name="email" id="email" required><br>
                </label>
                <label for="password">
                    Wachtwoord:
                    <input type="password" name="password" id="password" required><br>
                </label>
                <label>
                    <input type="submit" value="Log in" name="login">
                </label>
            </form>
        </div>
    </main>
    <footer>
    </footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.html", "header");
        includeHTML("footer.html", "footer");
    </script>
</body>

</html>