<?php

require_once 'Lang/translator.php';

$translator = init_translator();

?>

<html lang="nl">

<body>
    <div class="main-footer">
        <div class="footer-body">
            <div class="footer-wrap">
                <div class="footer-social">
                    <img src="./Images/logo_fittingly_dark.png" alt="logo van Fittingly met donkere tinten">
                    <p><?= $translator-> get('footer_navbar_1') ?></p>
                    <div class="footer-icons">
                        <img src="./Images/icons/insta-icon.png" alt="instagram icon">
                        <img src="./Images/icons/facebook-icon.png" alt="facebook icon">
                        <img src="./Images/icons/pinterest-icon.png" alt="pinterest icon">
                    </div>
                </div>
                <div class="footer-links">
                    <a href="index.php"><?= $translator-> get('footer_navbar_2') ?></a>
                    <a href="index.php#hero"><?= $translator-> get('footer_navbar_3') ?></a>
                    <a href="index.php#about"><?= $translator-> get('footer_navbar_4') ?></a>
                    <a href="partnerpagina.php"><?= $translator-> get('footer_navbar_5') ?></a>
                    <a href="contact.php"><?= $translator-> get('footer_navbar_6') ?></a>
                </div>
            </div>
            <div class="footer-newsletter">
                <p><?= $translator-> get('footer_newsletter_paragraph') ?></p>
                <input id="newsletter-input" type="email" placeholder="<?= $translator-> get('footer_formulier_email_placeholder') ?>">
                <button type="submit" class="footer-news"><?= $translator-> get('footer_submit_button') ?></button>
            </div>
        </div>
    </div>

    <hr>
    <div class="footer-copyright">
        <div class="footer-conditions">
            <a href="Privacyverklaring_Fittingly.pdf" target="_blank"><?=    $translator-> get('footer_privacypolicy') ?></a>
            <a href="Algemene_voorwaarden_Fittingly.pdf" target="_blank"><?= $translator-> get('footer_terms_conditions') ?></a>
        </div>
        <div>
            <span>&copy;<?= $translator-> get('footer_allrights') ?> </span>
        </div>
    </div>

</body>

</html>