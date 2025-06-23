<?php
/**
 * partnerpagina.php
 *
 * Partner page for Fittingly.
 * - Displays information for potential and current partners.
 * - Shows USPs (Unique Selling Points) for partners.
 * - Describes the platform and its benefits.
 * - Displays a slider with partner logos.
 * - Provides a call-to-action button for partner sign-up.
 * - Uses Translator for multilingual support.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 */

require_once 'Lang/Translator.php';

$translator = init_translator();

?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fittingly/Partners</title>
  <link rel="icon" href="Images/icons/favicon.ico">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/partnerPaginaStyle.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body style="background-image: url('./Images/onsdoelImages/background_dark.png');">
  <!--Stuk van Richard begin-->
  <header></header>

  <main>
    <div id="partnerpagina-container">
      <div class="background-container">
        <div id="koptekst-container">
          <h2 id="koptekst"> <?= $translator-> get('partnerpagina_h2') ?> </h2>
          <p class="header-paragraph-tekst"> <?= $translator-> get('partnerpagina_paragraph') ?> </p>
        </div>
        <div class="usp-div-container">
          <div class="usp-div">
            <div class="usp-div-img">
              <img class="usp-img" src="./Images/onsdoelImages/usp_Fittingly_dark.png" alt="">
            </div>
            <h5 class="usp-div-tekst"> <?= $translator-> get('partnerpagina_usp1') ?> </h5>
          </div>

          <div class="usp-div">
            <div class="usp-div-img">
              <img class="usp-img" src="./Images/onsdoelImages/usp_Fittingly_dark.png" alt="">
            </div>
            <h5 class="usp-div-tekst"> <?= $translator-> get('partnerpagina_usp2') ?> </h5>
          </div>

          <div class="usp-div">
            <div class="usp-div-img">
              <img class="usp-img" src="./Images/onsdoelImages/usp_Fittingly_dark.png" alt="">
            </div>
            <h5 class="usp-div-tekst"> <?= $translator-> get('partnerpagina_usp3') ?> </h5>
          </div>
        </div>
      </div>

      <!--Heading 2 onder USP's-->
      <div>
        <div class="ons-platform-container">
          <div class="ons-platform-tekst-container">
            <h3 class="ons-platform-heading-tekst1">
              <?= $translator-> get('partnerpagina_h3') ?>
            </h3>
            <h4 class="ons-platform-heading-tekst2">
              <?= $translator-> get('partnerpagina_h4') ?>
            </h4>
            <div id="couple-img-hidden"></div>
            <p class="ons-platform-paragraph-tekst2">
              <?= $translator-> get('partnerpagina_paragraph2') ?>
            </p>
          </div>
          <div class="ons-platform-img-container">

            <img id="img-couple" src="/public_html/Images/backgroundImages/faded_couple.png" alt="Mens Brown Long-Coat Model">
          </div>
        </div>

        <div>
          <h4 id="partner-koptekst"> <?= $translator-> get('partnerpagina_koptekst_h4') ?> </h4>
        </div>

        <!--De 4 plaatjes voor de slider-->
        <div class="slider">
          <div class="slide-track">
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Nomad_Thread.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/DBH.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Caunhing.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Bassinsins.jpg" alt="">
            </div>

            <!--Duplicate images, nodig om the infinite carousel mogelijk te maken. -->
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Nomad_Thread.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/DBH.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Caunhing.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Bassinsins.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Nomad_Thread.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/DBH.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Caunhing.jpg" alt="">
            </div>
            <div class="slide">
              <img class="slideimg" src="./Images/partnerLogos/Bassinsins.jpg" alt="">
            </div>
          </div>
        </div>

        <!--Aanmeldingknop onderaan de pagina met functie-->
        <div class="afsluiting-div-container">
          <div class="afsluiting-tekst-container">
            <p class="afsluiting-heading-tekst"> <?= $translator-> get('partnerpagina_afsluiting_p_1') ?> </p>
            <p class="afsluitings-paragraph">
              <?= $translator-> get('partnerpagina_afsluiting_p_2') ?>
            </p>
            <div>
              <a href="contact.php"><button class="aanmeld-button" onclick="pushButton()">
                  <?= $translator-> get('partnerpagina_aanmeld_button') ?>
                </button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer></footer>

  <script src="js/partnerPaginaScripts.js"></script>
  <script src="js/scripts.js"></script>
  <script>
    includeHTML("header.php", "header");
    includeHTML("footer.php", "footer");
  </script>
</body>

</html>