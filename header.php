<?php
session_start();

// Haal de taal uit de sessie (standaard 'nl' als niet ingesteld)
$lang = $_SESSION['lang'] ?? 'nl';

// Laad het juiste taalbestand
include "lang/$lang.php";
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
      <nav>
        <button>
          <a class="nav-button-tekst" href="index.php"><?= $header_navbar_1 ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="partnerpagina.php"><?= $header_navbar_2 ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="contact.php"><?= $header_navbar_3 ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="klantregistratie.php"><?= $header_navbar_4 ?></a>
        </button>
        <button>
          <a class="nav-button-tekst" href="inloggen.php"><?= $header_navbar_5 ?></a>
        </button>
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