<?php
session_start();
// Als er een taal gekozen is via de URL (bijvoorbeeld ?lang=nl of ?lang=en)
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];  // Sla de gekozen taal op in de sessie
}

// Als er geen taal is gekozen, gebruik dan de default taal 'nl'
$lang = $_SESSION['lang'] ?? 'nl';

// Laad het juiste taalbestand
include "lang/$lang.php";

require_once '../project_root/includes/signup/signup_view.inc.php';

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title> <?= $klantregistratiepagina_titel ?> </title>
</head

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact"> <?= $klantregistratiepagina_contact_h2 ?> </h2>
            <p id="para-contact"> <?= $klantregistratiepagina_contact_p ?> </p>
        </div>

        <div class="form-container">
            <div class="contact-info">

            </div>
            <form method="post" action="../project_root/includes/signup/signup.inc.php">
                <label for="name">
                    <?= $klantregistratiepagina_formulier_naam ?>
                    <input type="text" name="FirstName" id="firstname" required><br>
                </label>
                <label for="name">
                    <?= $klantregistratiepagina_formulier_achternaam ?>
                    <input type="text" name="LastName" id="lastname" required><br>
                </label>
                <label for="email">
                    <?= $klantregistratiepagina_formulier_email ?>
                    <input type="email" name="EmailAddress" id="email" required><br>
                </label>
                <label for="phone">
                    <?= $klantregistratiepagina_formulier_tel ?>
                    <input type="tel" name="PhoneNumber" id="phone"><br>
                </label>
                <label for="dateOfBirth">
                    <?= $klantregistratiepagina_formulier_geboortedatum ?>
                    <input type="date" name="DateOfBirth" id="dateOfBirth" required><br>
                </label>
                <label for="postalCode">
                    <?= $klantregistratiepagina_formulier_postcode ?>
                    <input type="text" name="PostalCode" id="postalCode" required><br>
                </label>
                <label for="streetName">
                    <?= $klantregistratiepagina_formulier_straat ?>
                    <input type="text" name="StreetName" id="streetName" required><br>
                </label>
                <label for="streetNumber">
                    <?= $klantregistratiepagina_formulier_huisnummer ?>
                    <input type="text" name="HouseNumber" id="streetNumber" required><br>
                </label>
                <label for="city">
                    <?= $klantregistratiepagina_formulier_stad ?>
                    <input type="text" name="City" id="city" required><br>
                </label>
                <label for="country">
                    <?= $klantregistratiepagina_formulier_land ?>
                    <input type="text" name="Country" id="country" required><br>
                </label>
                <label for="password">
                    <?= $klantregistratiepagina_formulier_wachtwoord ?>
                    <input type="password" name="UserPassword" id="password" required><br>
                </label>
                <label>
                    <input type="checkbox" name="newsletter">
                    <?= $klantregistratiepagina_formulier_nieuwsbrief ?><br>
                    <input type="submit" value="<?= $klantregistratiepagina_formulier_button; ?>" name="submit">
                </label>
                <?php 
                    check_signup_errors();
                ?>
            </form>
            <div>
                <?php
                check_signup_errors();/*
                include("Models/Person.php");
                include("Models/Address.php");
                include("Models/Message.php");
                include("Models/Customer.php");

                if(isset($_POST["submit"])){
                $newsletter = null;  
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $dateOfBirth = $_POST['dateOfBirth'];
                $password = $_POST["password"];

                $person = new Person($name, $email, $phone, $email, $dateOfBirth, $password, null); -- moet hier 2x $email zijn? En waarom null?

                $address = new Address($_POST['postalCode'],
                $_POST['streetName'],
                $_POST['streetNumber'],
                $_POST['streetNumberAppendix'],
                $_POST['city'],
                $_POST['country']);

                $person->address = $address;

                $message = new Message($person->getName(), "Thank you for registering!", "Kind regards,<br>Fittingly");

                if(isset($_POST["newsletter"])){
                $newsletter = true;
                }
                else{
                $newsletter = false;
                }

                echo"<br>";
                echo $person . " and " . $person->address;
                echo "<br>";
                echo "<br>";
                echo $message;
                echo "<br>";
                echo "<br>";
                echo $person->getPassword();


                } */
                ?>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer");
    </script>
</body>

</html>