<?php

require_once 'Lang/translator.php';

$translator = init_translator();

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/registration_login.css">
    <title> <?= $translator->get('klantregistratiepagina_titel') ?> </title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 class="h2-registration-login"> <?= $translator->get('klantregistratiepagina_contact_h2') ?> </h2>
            <p class="p-registration-login"> <?= $translator->get('klantregistratiepagina_contact_p') ?> </p>


            <div class="registration-login-form-container">

                <form method="post" action="../project_root/Controllers/registration_customer_controller.php">
                    <label for="name">
                        <?= $translator->get('klantregistratiepagina_formulier_naam') ?>
                        <input type="text" name="FirstName" id="firstname" required><br>
                    </label>
                    <label for="name">
                        <?= $translator->get('klantregistratiepagina_formulier_achternaam') ?>
                        <input type="text" name="LastName" id="lastname" required><br>
                    </label>
                    <label for="email">
                        <?= $translator->get('klantregistratiepagina_formulier_email') ?>
                        <input type="email" name="EmailAddress" id="email" required><br>
                    </label>
                    <label for="phone">
                        <?= $translator->get('klantregistratiepagina_formulier_tel') ?>
                        <input type="tel" name="PhoneNumber" id="phone"><br>
                    </label>
                    <label for="dateOfBirth">
                        <?= $translator->get('klantregistratiepagina_formulier_geboortedatum') ?>
                        <input type="date" name="DateOfBirth" id="dateOfBirth" required><br>
                    </label>
                    <label for="postalCode">
                        <?= $translator->get('klantregistratiepagina_formulier_postcode') ?>
                        <input type="text" name="PostalCode" id="postalCode" required><br>
                    </label>
                    <label for="streetName">
                        <?= $translator->get('klantregistratiepagina_formulier_straat') ?>
                        <input type="text" name="StreetName" id="streetName" required><br>
                    </label>
                    <label for="streetNumber">
                        <?= $translator->get('klantregistratiepagina_formulier_huisnummer') ?>
                        <input type="text" name="HouseNumber" id="streetNumber" required><br>
                    </label>
                    <label for="city">
                        <?= $translator->get('klantregistratiepagina_formulier_stad') ?>
                        <input type="text" name="City" id="city" required><br>
                    </label>
                    <label for="country">
                        <?= $translator->get('klantregistratiepagina_formulier_land') ?>
                        <input type="text" name="Country" id="country" required><br>
                    </label>
                    <label for="password">
                        <?= $translator->get('klantregistratiepagina_formulier_wachtwoord') ?>
                        <input type="password" name="UserPassword" id="password" required><br>
                    </label>
                    <label>
                        <input type="checkbox" name="newsletter">
                        <?= $translator->get('klantregistratiepagina_formulier_nieuwsbrief') ?><br>
                        <input type="submit" value="<?= $translator->get('klantregistratiepagina_formulier_button') ?>" name="submit">
                    </label>
                </form>
            </div>
            <?php if (isset($_SESSION['registration_error'])): ?>
                <p class="error"><?= $_SESSION['registration_error'];
                                    unset($_SESSION['registration_error']); ?></p>
            <?php endif; ?>
            <div>
            </div>
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