<?php

/**
 * klantregistratie.php
 *
 * Customer registration page for Fittingly.
 * - Displays a registration form for new customers.
 * - Uses Translator for multilingual support.
 * - Handles POST requests to register new users via registration_handler.php.
 * - Shows success or error messages after registration.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 * @var string $message    Registration status message from GET parameter.
 */

require_once 'Lang/Translator.php';

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

                <form method="POST" action="../project_root/Core/registration_handler.php">
                    <?php
                    if (isset($_SESSION['registration_error'])): ?>
                        <p class="error"><?= $_SESSION['registration_error'];
                                            unset($_SESSION['registration_error']); ?></p>
                    <?php endif; ?>
                    <div class="form-row">
                        <br>
                        <h3><?= $translator->get('klantregistratiepagina_formulier_formrow_persoon') ?>:</h3>
                    </div>
                    <div class="form-row-registration">
                        <label for="name">
                            <?= $translator->get('klantregistratiepagina_formulier_naam') ?>
                            <input type="text" name="FirstName" id="firstname"><br>
                        </label>
                        <label for="name">
                            <?= $translator->get('klantregistratiepagina_formulier_achternaam') ?>
                            <input type="text" name="LastName" id="lastname"><br>
                        </label>
                    </div>

                    <div class="form-row-registration">
                        <label for="streetName">
                            <?= $translator->get('klantregistratiepagina_formulier_straat') ?>
                            <input type="text" name="StreetName" id="streetName"><br>
                        </label>
                        <label for="streetNumber">
                            <?= $translator->get('klantregistratiepagina_formulier_huisnummer') ?>
                            <input type="text" name="HouseNumber" id="streetNumber"><br>
                        </label>
                        <label for="postalCode">
                            <?= $translator->get('klantregistratiepagina_formulier_postcode') ?>
                            <input type="text" name="PostalCode" id="postalCode"><br>
                        </label>


                    </div>
                    <div class="form-row-registration">
                        <label for="city">
                            <?= $translator->get('klantregistratiepagina_formulier_stad') ?>
                            <input type="text" name="City" id="city"><br>
                        </label>
                        <label for="country">
                            <?= $translator->get('klantregistratiepagina_formulier_land') ?>
                            <input type="text" name="Country" id="country"><br>
                        </label>
                    </div>
                    <div class="form-row">
                        <label for="phone">
                            <?= $translator->get('klantregistratiepagina_formulier_tel') ?>
                            <input type="tel" name="PhoneNumber" id="phone"><br>
                        </label>
                        <label for="dateOfBirth">
                            <?= $translator->get('klantregistratiepagina_formulier_geboortedatum') ?>
                            <input type="date" name="DateOfBirth" id="dateOfBirth"><br>
                        </label>
                    </div>

                    <div class="form-row">
                        <br>
                        <h3><?= $translator->get('klantregistratiepagina_formulier_formrow_login') ?>:</h3>
                    </div>
                    <div class="form-row-login">
                        <label for="email">
                            <?= $translator->get('klantregistratiepagina_formulier_email') ?>
                            <input type="email" name="EmailAddress" id="email"><br>
                        </label>
                        <label for="password">
                            <?= $translator->get('klantregistratiepagina_formulier_wachtwoord') ?>
                            <input type="password" name="UserPassword" id="password"><br>
                        </label>

                    </div>
                    <div class="form-row-button-newsletter-container">
                        <div id="form-row-newsletter-container">
                            <label id="newsletter-checkbox-label">
                                <input type="checkbox" name="newsletter">
                                <p id="newsletter-checkbox-text"><?= $translator->get('klantregistratiepagina_formulier_nieuwsbrief') ?></p>
                            </label>
                        </div>
                        <div id="login-button-container">
                            <input type="submit" value="<?= $translator->get('klantregistratiepagina_formulier_button') ?>" name="submit">
                        </div>
                    </div>
                </form>
            </div>
            <?php
            $message = htmlspecialchars($_GET['message'] ?? '', ENT_QUOTES, 'UTF-8');
            if ($message === 'thankyou'): ?>
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        alert("Thank you for registering!");
                    });
                </script>
            <?php endif; ?>

            <?php if ($message === 'error'): ?>
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        alert("Please fill in all fields.");
                    });
                </script>
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