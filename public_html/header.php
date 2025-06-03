<?php

require_once 'Lang/translator.php';
$translator = init_translator();

require_once '../project_root/Core/Session.php';

use Core\Session;

Session::start();

?>

<html lang="nl">

<body>
  <div class="main-container">
    <a href="Cart.php" class="cart-icon-link" aria-label="Naar winkelwagen">
  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
    <circle cx="9" cy="21" r="1"></circle>
    <circle cx="20" cy="21" r="1"></circle>
    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
  </svg>
</a>
    <div class="header-flexbox">
      <a href="index.php"><img
          class="header-logo"
          src="./Images/logo_fittingly_light.png"
          alt="Het logo van Fittingly"></a>
      <h1 class="main-title">Fittingly</h1>
      <button class="hamburger">
        <img
          src="./Images/hamburger-dark.png"
          onclick="changeNav()"
          alt="menu knop">
      </button>

      <nav>
        <button>
          <a class="nav-button-tekst" href="index.php"><?= $translator->get('header_navbar_1') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="productpagina.php"><?= $translator->get('header_navbar_7') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="partnerpagina.php"><?= $translator->get('header_navbar_2') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="contact.php"><?= $translator->get('header_navbar_3') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="klantregistratie.php"><?= $translator->get('header_navbar_4') ?></a>
        </button>

        <?php if (!Session::exists('user_email')): ?>
          <button>
            <a class="nav-button-tekst" href="inloggen.php"><?= $translator->get('header_navbar_5') ?></a>
          </button>
        <?php endif; ?>

        <?php if (Session::exists('user_email')): ?>
          <button>
            <a class="nav-button-tekst" href="uitloggen.php"><?= $translator->get('header_navbar_6') ?></a>
          <?php endif; ?>
      </nav>


      <button class="language-button" onclick="changeLang()"><img class="header-lang-img" src="./Images/icons/vlag-nederlands-engels.png" alt="">▼</button>
      <nav id="language-dropdown" class="language-dropdown">
        <?php if(!Session::exists('id')): ?>
        <button>
          <a href="?lang=nl">
            <img class="header-lang-img" src="./Images/icons/netherlands_flag.png" alt="Nederlands">
          </a>
        </button>
        <button>
          <a href="?lang=en">
            <img class="header-lang-img" src="./Images/icons/Flag_of_the_United_Kingdom.png" alt="English">
          </a>
        </button>
        <?php else: ?>
          <button>
          <a href="<?php echo("?id=" . "{$_SESSION['id']}" . "&lang=nl")?>">
            <img class="header-lang-img" src="./Images/icons/netherlands_flag.png" alt="Nederlands">
          </a>
        </button>
        <button>
          <a href="<?php echo("?id=" . "{$_SESSION['id']}" . "&lang=en")?>">
            <img class="header-lang-img" src="./Images/icons/Flag_of_the_United_Kingdom.png" alt="English">
          </a>
        </button>
        <?php endif; ?>
      </nav>

    </div>
  </div>
</body>

</html>