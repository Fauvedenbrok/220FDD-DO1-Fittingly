<?php
session_start();

// Haal de taal uit de sessie (standaard 'nl' als niet ingesteld)
$lang = $_SESSION['lang'] ?? 'nl';

// Laad het juiste taalbestand
include "lang/$lang.php";
?>

<html lang="nl">

<body>
    <div class="main-footer">
        <div class="footer-body">
            <div class="footer-wrap">
                <div class="footer-social">
                    <img src="/Images/logo_fittingly_dark.png" alt="logo van Fittingly met donkere tinten">
                    <p><?= $footer_navbar_1 ?></p>
                    <div class="footer-icons">
                        <img src="../Images/icons/insta-icon.png" alt="instagram icon">
                        <img src="../Images/icons/facebook-icon.png" alt="facebook icon">
                        <img src="../Images/icons/pinterest-icon.png" alt="pinterest icon">
                    </div>
                </div>
                <div class="footer-links">
                    <a href="index.php"><?= $footer_navbar_2 ?></a>
                    <a href="index.php#hero"><?= $footer_navbar_3 ?></a>
                    <a href="index.php#about"><?= $footer_navbar_4 ?></a>
                    <a href="partnerpagina.php"><?= $footer_navbar_5 ?></a>
                    <a href="contact.php"><?= $footer_navbar_6 ?></a>
                </div>
            </div>
            <div class="footer-newsletter">
                <p><?= $footer_newsletter_paragraph ?></p>
                <input id="newsletter-input" type="email" placeholder="<?= $footer_formulier_email_placeholder ?>">
                <button type="submit" class="footer-news"><?= $footer_submit_button ?></button>
            </div>
        </div>
    </div>

    <hr>
    <div class="footer-copyright">
        <div class="footer-conditions">
            <a href="Privacyverklaring_Fittingly.pdf" target="_blank"><?= $footer_privacypolicy ?></a>
            <a href="Algemene_voorwaarden_Fittingly.pdf" target="_blank"><?= $footer_terms_conditions ?></a>
        </div>
        <div>
            <span>&copy;<?= $footer_allrights ?> </span>
        </div>
    </div>

</body>

</html>