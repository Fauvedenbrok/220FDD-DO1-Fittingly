<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title>Klant registratie</title>
</head>
<body>
<div class="background-container">
            <h2 id="h2-contact">Registratie</h2>
            <p id="para-contact">EVEN AANPASSEN </p>
        </div>

        <div class="form-container">
            <div class="contact-info">
                <h3 id="h3-contact">Contactinformatie</h3>
                <p><img id="usp1-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Adres: Straat
                    123, 1021 AB, Breda</p>
                <p><img id="usp2-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Telefoon:
                    +31631506081</p>
                <p><img id="usp3-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Email:
                    info@fittingly.nl</p>
            </div>

            <form method="post" action="partnerregistratie.php" id="contact-form">
      <label for="name">
        Naam:
        <input type="text" name="name" id="name"><br>
    </label>
    <label for="email">
        E-mail:
        <input type="email" name="email" id="email"><br>
    </label>
    <label for="phone">
        Telefoon:
        <input type="text" name="phone"><br>
    </label>
    <label for="dateOfBirth">
        Geboortedatum:
        <input type="date" name="dateOfBirth"><br>
    </label>

    <label for="postalCode">
        Postcode:
        <input type="text" name="postalCode"><br>
    </label>
    <label for="streetName">
        Straat:
        <input type="text" name="streetName"><br>
    </label>
    <label for="streetNumber">
        Huisnummer:
        <input type="text" name="streetNumber"><br>
    </label>
    <label for="streetNumberAppendix">
        Huisnummer toevoeging:
        <input type="text" name="streetNumberAppendix"><br>
    </label>
    <label for="city">
        Stad:
        <input type="text" name="city"><br>
    </label>
    <label for="country">
        Land:
        <input type="text" name="country"><br>
    </label>
    <label for="password">
        Wachtwoord:
        <input type="password" name="password"><br>
    </label>
    <label>
    <input type="checkbox" name="newsletter">
    Nieuwsbrief<br>
    </label>


    <input type="submit" value="Registreer" name="submit">

            </form>
        </div>
    </main>

    <footer></footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.html", "header");
        includeHTML("footer.html", "footer")
    </script>
    <script src="js/contact.js"></script>

</body>
</html>
<?php
include("Models/Person.php");
include("Models/Address.php");
include("Models/Message.php");
include("Models/LoginData.php");
include("Models/Account.php");

$loginData = new LoginData($_POST["email"], $_POST["password"]);
$person = null;
$newsletter = null;

if(empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['phone']) ||
    empty($_POST['dateOfBirth'])) {
    echo"Please fill in all fields";
}
else{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateOfBirth = $_POST['dateOfBirth'];

    $person = new Person($name, $phone, $email, $dateOfBirth, null);
}

$address = new Address($_POST['postalCode'],
    $_POST['streetName'],
    $_POST['streetNumber'],
    $_POST['streetNumberAppendix'],
    $_POST['city'],
    $_POST['country']);


$person->address = $address;


echo"<br>";
echo $person . " and " . $person->address;
echo "<br>";


$message = new Message($person->getName(), "Thank you for registering!", "Kind regards,<br>Fittingly");
echo $message;
echo "<br>";
echo "<br>";


echo $loginData->getPassword() . " " . $loginData->getUsername();
if(isset($_POST["submit"])){
    if(isset($_POST["newsletter"])){
        $newsletter = true;
    }
    else{
        $newsletter = false;
    }
}

$account = new Account($loginData, $person, 3, $newsletter);

$_SESSION["account"] = $account;
?>