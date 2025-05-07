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
                    <img src="./Images/logo_fittingly_dark.png" alt="logo van Fittingly met donkere tinten">
                    <p>Vind ons:</p>
                    <div class="footer-icons">
                        <img src="./Images/icons/insta-icon.png" alt="instagram icon">
                        <img src="./Images/icons/facebook-icon.png" alt="facebook icon">
                        <img src="./Images/icons/pinterest-icon.png" alt="pinterest icon">
                    </div>
                </div>
                <div class="footer-links">
                    <a href="index.php">Home</a>
                    <a href="index.php#hero">Ons platform</a>
                    <a href="index.php#about">Ons doel</a>
                    <a href="partnerpagina.php">Partner worden?</a>
                    <a href="contact.php">Contact</a>
                </div>
            </div>
            <div class="footer-newsletter">
                <p>Blijf op de hoogte van updates en nieuws:</p>
                <input id="newsletter-input" type="email" placeholder="email@voorbeeld.nl">
                <button type="submit" class="footer-news">Aanmelden</button>
            </div>
        </div>
    </div>

    <hr>
    <div class="footer-copyright">
        <div class="footer-conditions">
            <a href="Privacyverklaring_Fittingly.pdf" target="_blank">Privacyverklaring</a>
            <a href="Algemene_voorwaarden_Fittingly.pdf" target="_blank">Algemene voorwaarden</a>
        </div>
        <div>
            <span>&copy;Fittingly, alle rechten voorbehouden</span>
        </div>
    </div>

</body>

</html>