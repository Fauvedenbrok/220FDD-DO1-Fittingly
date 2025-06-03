<?php

require_once __DIR__ . '/../../public_html/Lang/translator.php';

$translator = init_translator();

?>

<html lang="nl">

<body>
  <div class="main-container">
    <div class="header-flexbox">
      <img class="header-logo" src="/public_html/Images/logo_fittingly_light.png" alt="Het logo van Fittingly">
      <h1 class="main-title">Fittingly</h1>
      <button class="hamburger">
        <img
          src="./Images/hamburger-dark.png"
          onclick="changeNav()"
          alt="menu knop">
      </button>
      
      <nav>
        <button>
          <a class="nav-button-tekst" href="adminportal.php"><?= $translator->get('admin-navbar_1') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="products.php"><?= $translator->get('admin-navbar_2') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="admin_searchwords.php"><?= $translator->get('admin-navbar_5') ?></a>
        </button>
        <!-- <button>
          <a class="nav-button-tekst" href="settings.php"><?= $translator->get('admin-navbar_7') ?></a>
        </button> -->
        <button>
          <a class="nav-button-tekst" href="https://mail.one.com/mail/INBOX/1" target="_blank"><?= $translator->get('admin-navbar_4') ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="/public_html/uitloggen.php"><?= $translator->get('admin-navbar_8') ?></a>
        </button>
      </nav>



      <button class="language-button" onclick="changeLang()"><img class="header-lang-img" src="./Images/icons/vlag-nederlands-engels.png" alt="">▼</button>
      <nav id="language-dropdown" class="language-dropdown">
        <button>
          <a href="?lang=nl">
            <img class="header-lang-img" src="/public_html/Images/icons/netherlands_flag.png" alt="Nederlands">
          </a>
        </button>
        <button>
          <a href="?lang=en">
            <img class="header-lang-img" src="/public_html/Images/icons/Flag_of_the_United_Kingdom.png" alt="English">
          </a>
        </button>
      </nav>

    </div>
  </div>
</body>

</html>