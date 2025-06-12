<?php

require_once 'Lang/translator.php';

$translator = init_translator();

?>



<!DOCTYPE html>

<!-- wanneer de taal veranderd (button) moet deze tag ook veranderen naar de taal -->
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fittingly</title>
  <link rel="icon" href="./Images/icons/favicon.ico">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="./css/indexstyles.css">
</head>

<body>
  <header>
  </header>
  
  <div class="splash-screen">
    <div class="logo-splash"></div>
    <h1 class="brandname-splash">Fittingly</h1>
    <h2 class="slogan-splash">Rent your perfect fit</h2>
  </div>
  <main class="main-content">
    <!-- <button id="mode-toggle" class="mode-toggle">Light Mode</button> -->
    <div class="hero-sectie" id="hero">
      <div class="hero-sectie-klanten">
        <div class="hero-content">
          <h2>Rent your perfect fit</h2>
          <button class="cta-partner-hero" onclick="window.location.href='/public_html/productpagina.php'"> <?= $translator->get('hero_content_productpagina_button') ?> </button>

          <!-- <div class="timer">
            <div class="card days">
              <span>00</span>
              <p class="timer-text">Days</p>
            </div>
            <div class="card hours">
              <span>00</span>
              <p class="timer-text">Hours</p>
            </div>
            <div class="card minutes">
              <span>00</span>
              <p class="timer-text">Minutes</p>
            </div>
            <div class="card seconds">
              <span>00</span>
              <p class="timer-text">Seconds</p>
            </div>
          </div> -->
          
        </div>
      </div>
      <div class="hero-sectie-partners">
        <div class="hero-content">
          <h2> <?= $translator->get('hero_content_h2') ?> </h2>
          <button id="cta-partner-hero-button2" class="cta-partner-hero" onclick="window.location.href='/public_html/partnerpagina.php'"> <?= $translator->get('hero_content_partnerpagina_button') ?> </button>
        </div>
      </div>
      <div class="scroll-info">
        <p> <?= $translator->get('scroll_info_text') ?> </p>
        <div class="arrow"></div>
      </div>
    </div>
    <div class="onsdoel-container">
      <div id="about" class="index-textopmaak-1">
        <div class="index-textopmaak-2">
          <h3> <?= $translator->get('about_h3') ?> </h3>
          <h4> <?= $translator->get('about_h4') ?> </h4>
          <div class="image-mobile image-about"></div>
          <p class="index-paragraph-tekst-1"> <?= $translator->get('about_text') ?> </p>
        </div>
        <div class="image-blok-1"><img src="./Images/onsdoelImages/mobieldesign.png" alt="Mobiele weergave afbeelding"
            class="image-right"></div>
      </div>

      <div class="slider-container">
        <div class="slider">
          <img src="./Images/onsdoelImages/Dress1.jpg" alt="Slider afbeelding 1" class="slider-image">
          <img src="./Images/onsdoelImages/Dress2.jpg" alt="Slider afbeelding 2" class="slider-image">
          <img src="./Images/onsdoelImages/Suit1.jpg" alt="Slider afbeelding 3" class="slider-image">
          <img src="./Images/onsdoelImages/Suit2.jpg" alt="Slider afbeelding 4" class="slider-image">
          <img src="./Images/onsdoelImages/Suit3.jpg" alt="Slider afbeelding 5" class="slider-image">
          <img src="./Images/onsdoelImages/Suit5.jpeg" alt="Slider afbeelding 6" class="slider-image">
          <img src="./Images/onsdoelImages/dress5.jpg" alt="Slider afbeelding 7" class="slider-image">
          <img src="./Images/onsdoelImages/suit6.jpg" alt="Slider afbeelding 8" class="slider-image">
          <img src="./Images/onsdoelImages/suit7.jpg" alt="Slider afbeelding 9" class="slider-image">
          <img src="./Images/onsdoelImages/suit8.jpg" alt="Slider afbeelding 10" class="slider-image">
          <img src="./Images/onsdoelImages/Dress1.jpg" alt="Slider afbeelding 1" class="slider-image">
          <img src="./Images/onsdoelImages/Dress2.jpg" alt="Slider afbeelding 2" class="slider-image">
          <img src="./Images/onsdoelImages/Suit1.jpg" alt="Slider afbeelding 3" class="slider-image">
          <img src="./Images/onsdoelImages/Suit2.jpg" alt="Slider afbeelding 4" class="slider-image">
          <img src="./Images/onsdoelImages/Suit3.jpg" alt="Slider afbeelding 5" class="slider-image">
          <img src="./Images/onsdoelImages/Suit5.jpeg" alt="Slider afbeelding 6" class="slider-image">
          <img src="./Images/onsdoelImages/dress5.jpg" alt="Slider afbeelding 7" class="slider-image">
          <img src="./Images/onsdoelImages/suit6.jpg" alt="Slider afbeelding 8" class="slider-image">
          <img src="./Images/onsdoelImages/suit7.jpg" alt="Slider afbeelding 9" class="slider-image">
          <img src="./Images/onsdoelImages/suit8.jpg" alt="Slider afbeelding 10" class="slider-image">
        </div>
      </div>

      <div id="goal" class="index-textopmaak-1">
        <img src="./Images/onsdoelImages/faded_bride.png" alt="Placeholder afbeelding" class="image-left">
        <div class="index-textopmaak-2">
          <h3> <?= $translator->get('index_textopmaak_h3') ?> </h3>
          <h4> <?= $translator->get('index_textopmaak_h4') ?> </h4>
          <div class="image-mobile image-goal"></div>
          <p class="index-paragraph-tekst-2"> <?= $translator->get('index_paragraph_text') ?> </p>
          <div class="usp-container">
            <div class="usp-item">
              <img src="./Images/onsdoelImages/usp_Fittingly_light.png" alt="USP1Light" class="hexagon">

              <p class="gold-text"> <?= $translator->get('usp_container_1') ?> </p>
            </div>
            <div class="usp-item">
              <img src="./Images/onsdoelImages/usp_Fittingly_light.png" alt="USP2Light" class="hexagon">
              <p class="gold-text"> <?= $translator->get('usp_container_2') ?> </p>
            </div>
            <div class="usp-item">
              <img src="./Images/onsdoelImages/usp_Fittingly_light.png" alt="USP3Light" class="hexagon">
              <p class="gold-text"> <?= $translator->get('usp_container_3') ?> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer>
  </footer>

  <script src="js/scripts.js"></script>
  <script src="js/onsdoelscript.js"></script>

 <script>
  const translations = {
      usp1: "<?= $translator->get('translation.usp1') ?>",
      usp2: "<?= $translator->get('translation.usp2') ?>",
      usp3: "<?= $translator->get('translation.usp3') ?>"
  };
</script>

<script>
  includeHTML("/public_html/header.php", "header");
  includeHTML("/public_html/footer.php", "footer");
</script>




</body>

</html>