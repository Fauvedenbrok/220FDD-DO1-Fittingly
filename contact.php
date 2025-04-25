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
?>


<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fittingly/Contact</title>
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact"> <?= $contactpagina_h2_contact ?> </h2>
            <p id="para-contact"> <?= $contactpagina_p_contact ?> </p>
        </div>

        <div class="form-container">
            <div class="contact-info">
                <h3 id="h3-contact"> <?= $contactpagina_h2_contact ?> </h3>
                <p><img id="usp1-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp"> <?= $contactpagina_p_contactinfo_1 ?> </p>
                <p><img id="usp2-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp"> <?= $contactpagina_p_contactinfo_2 ?> </p>
                <p><img id="usp3-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp"> <?= $contactpagina_p_contactinfo_3 ?> </p>
            </div>
            <form id="contact-form">
                <div class="form-content">
                    <div class="input-fields">
                        <label for="naam"> <?= $contactpagina_formulier_naam ?>:</label>
                        <input type="text" id="naam" placeholder="<?= $contactpagina_formulier_naam_placeholder?> ">
                        <small class="error"></small>

                        <label for="bedrijf"> <?= $contactpagina_formulier_bedrijf ?>:</label>
                        <input type="text" id="bedrijf" placeholder="<?= $contactpagina_formulier_bedrijf_placeholder?> ">
                        <small class="error"></small>

                        <label for="email"> <?= $contactpagina_formulier_email ?>:</label>
                        <input type="text" id="email" placeholder="<?= $contactpagina_formulier_email_placeholder ?>" autocomplete="off">
                        <small class="error"></small>

                        <label for="tel"> <?= $contactpagina_formulier_tel ?>:</label>
                        <input type="text" id="tel" placeholder="<?= $contactpagina_formulier_bericht_placeholder ?>" autocomplete="off">
                        <small class="error"></small>

                        <div class="input-bericht">
                            <label for="bericht"> <?= $contactpagina_formulier_bericht ?></label>
                            <textarea id="bericht" placeholder="Bericht" rows="12"></textarea>
                            <small class="error"></small>
                        </div>
                        <div class="button-wrapper">
                            <button class="button-container" type="submit" value="Verzenden"> <?= $contactpagina_formulier_button ?> </button>
                        </div>
                        <p id="send"></p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer></footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer")
    </script>
    <script src="js/contact.js"></script>
</body>

</html>