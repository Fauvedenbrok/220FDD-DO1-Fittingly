<?php
session_start();
require_once __DIR__ . '/../../public_html/Lang/translator.php';
// Haal de taal uit de sessie (standaard 'nl' als niet ingesteld)

if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'nl';
// Laad het juiste taalbestand

$translator = new Translator($lang);
?>

<html lang="nl">

<body>
  <div class="main-container">
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

      <nav class="admin-nav">
        <ul class="admin-nav-list">
          <button>
            <li><a href="adminportal.php"><?= $translator->get('admin-navbar_1') ?></a></li>
          </button>
          <button>
            <li><a href="products.php"><?= $translator->get('admin-navbar_2') ?></a></li>
          </button>
          <button>
            <li><a href="orders.php"><?= $translator->get('admin-navbar_3') ?></a></li>
          </button>
          <button>
            <li><a href="messages.php"><?= $translator->get('admin-navbar_4') ?></a></li>
          </button>
          <button>
            <li><a href="returns.php"><?= $translator->get('admin-navbar_5') ?></a></li>
          </button>
          <button>
            <li><a href="customers.php"><?= $translator->get('admin-navbar_6') ?></a></li>
          </button>
          <button>
            <li><a href="settings.php"><?= $translator->get('admin-navbar_7') ?></a></li>
          </button>
          <button>
            <li><a href="/public_html/index.php"><?= $translator->get('admin-navbar_8') ?></a></li>
          </button>
        </ul>
      </nav>



      <button class="language-button" onclick="changeLang()"><img class="header-lang-img" src="./Images/icons/vlag-nederlands-engels.png" alt="">▼</button>
      <nav id="language-dropdown" class="language-dropdown">
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
      </nav>

    </div>
  </div>
</body>

</html>