<?php
/**
 * adminheader.php
 *
 * Header template for the admin section of Fittingly.
 * - Displays the logo, navigation bar, and language switcher.
 * - Shows account dropdown with login/logout options based on session.
 * - Uses Translator for multilingual support.
 * - Uses Session and UserAccounts to display the logged-in admin's name.
 *
 * Variables:
 * @var object $translator Translator object for multilingual labels.
 * @var string|null $userName The name of the logged-in admin user (if any).
 */

require_once __DIR__ . '/../../public_html/Lang/Translator.php';

$translator = init_translator();

require_once '../../project_root/Core/Session.php';
require_once '../../project_root/Models/UserAccounts.php';
require_once '../../project_root/Models/CrudModel.php';

use Core\Session;
use Models\UserAccounts;



?>

<html lang="nl">

<body>
  <div class="main-container">
    <div class="header-flexbox">
      <img class="header-logo" src="/public_html/Images/logo_fittingly_light.png" alt="Het logo van Fittingly">
      <h1 class="main-title">Fittingly</h1>
      <button class="hamburger">
        <img
          src="/public_html/Images/hamburger-dark.png"
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

        <?php if (Session::exists('user_email')): $userName = UserAccounts::getUserNameBySession(); ?>

          <div class="account-dropdown">
            <button class="account-btn" onclick="toggleAccountMenu()">
              <img src="/public_html/Images/icons/profiel.png" alt="Account">
              <span class="nav-profiel"> <?= $translator->get('header_navbar_8') ?> <?= htmlspecialchars($userName) ?>
              </span>

            </button>
            <div id="account-menu" class="account-menu">
              <a class="nav-button-tekst" href="../../project_root/Core/login_handler.php?action=adminlogout"><?= $translator->get('header_navbar_6') ?></a>
            </div>
          </div>

        <?php else: ?>
          <div class="account-dropdown">
            <button class="account-btn" onclick="toggleAccountMenu()">
              <img src="/public_html/Images/icons/profiel.png" alt="Account">
              <span class="nav-profiel">
                <?= $translator->get('header_dropdown_text') ?>
              </span>
            </button>
            <div id="account-menu" class="account-menu">
              <a class="nav-button-tekst" href="/public_html/inloggen.php"><?= $translator->get('header_navbar_5') ?></a>
            </div>

          </div>
        <?php endif; ?>
      </nav>



      <button class="language-button" onclick="changeLang()"><img class="header-lang-img" src="/public_html/Images/icons/vlag-nederlands-engels.png" alt="">▼</button>
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