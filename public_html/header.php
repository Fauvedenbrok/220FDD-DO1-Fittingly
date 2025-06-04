<?php

require_once 'Lang/translator.php';
$translator = init_translator();

require_once '../project_root/Core/Session.php';
require_once '../project_root/Models/UserAccounts.php';
require_once '../project_root/Models/CrudModel.php';

use Core\Session;
use Models\UserAccounts;

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
        <button class="nav-button">
          <a class="nav-button-tekst" href="index.php"><?= $translator->get('header_navbar_1') ?></a>
        </button>
        <button class="nav-button">
          <a class="nav-button-tekst" href="productpagina.php"><?= $translator->get('header_navbar_7') ?></a>
        </button>
        <button class="nav-button">
          <a class="nav-button-tekst" href="partnerpagina.php"><?= $translator->get('header_navbar_2') ?></a>
        </button>
        <button class="nav-button">
          <a class="nav-button-tekst" href="contact.php"><?= $translator->get('header_navbar_3') ?></a>
        </button>
        <?php
        $cartHref = Session::exists('user_email') ? 'Cart.php' : 'inloggen.php';
        ?>
        <button id="winkelmand-btn">
          <a href="<?= $cartHref ?>"><img src="./Images/icons/winkelmand.png" alt="Account" style="width:32px;height:32px;"></a>
        </button>
        <?php if (Session::exists('user_email')):
            $userName = UserAccounts::getUserNameBySession();
        ?>
        <div class="account-dropdown">
          <button id="account-btn" onclick="toggleAccountMenu()" style="background: none; border: none; padding: 0; display: flex; align-items: center;">
            <img src="./Images/icons/profiel.png" alt="Account" style="width:32px;height:32px;">
            <span class="nav-profiel" style="margin-left: 12px;"> <?= $translator->get('header_navbar_8')?> <?= htmlspecialchars($userName) ?>
            </span>
          </button>
          <div id="account-menu" class="account-menu">
            <a class="nav-button-tekst" href="mijnaccount.php"><?= $translator->get('header_navbar_9')?></a><br>
            <a class="nav-button-tekst" href="../project_root/Core/LoginHandler.php?action=logout"><?= $translator->get('header_navbar_6') ?></a>
          </div>
        </div>
      <?php else: ?>
        <div class="account-dropdown">
          <button id="account-btn" onclick="toggleAccountMenu()" style="background: none; border: none; padding: 0; display: flex; align-items: center;">
            <img src="./Images/icons/profiel.png" alt="Account" style="width:32px;height:32px;">
            <span class="nav-profiel" style="margin-left: 12px;">
              Account
            </span>
          </button>
          <div id="account-menu" class="account-menu">
            <a class="nav-button-tekst" href="inloggen.php"><?= $translator->get('header_navbar_5') ?></a><br>
            <a class="nav-button-tekst" href="klantregistratie.php"><?= $translator->get('header_navbar_4') ?></a>
          </div>
        </div>
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
    <script src="js/accountmenu.js"></script>
  </div>
</body>

</html>