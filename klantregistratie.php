<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <title>Klant registratie</title>
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact">Registratie</h2>
            <p id="para-contact">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore alias expedita eius! Ut enim fugiat eum pariatur non amet laudantium. Temporibus possimus non rerum exercitationem nesciunt officiis asperiores dolores impedit? </p>
        </div>

        <div class="form-container">
            <div class="contact-info">

            </div>
            <form method="post" action="klantregistratie.php">
                <label for="name">
                    Naam:
                    <input type="text" name="name" id="name" required><br>
                </label>
                <label for="email">
                    E-mail:
                    <input type="email" name="email" id="email" required><br>
                </label>
                <label for="phone">
                    Telefoon:
                    <input type="tel" name="phone" id="phone" required><br>
                </label>
                <label for="dateOfBirth">
                    Geboortedatum:
                    <input type="date" name="dateOfBirth" id="dateOfBirth" required><br>
                </label>
                <label for="postalCode">
                    Postcode:
                    <input type="text" name="postalCode" id="postalCode" required><br>
                </label>
                <label for="streetName">
                    Straat:
                    <input type="text" name="streetName" id="streetName" required><br>
                </label>
                <label for="streetNumber">
                    Huisnummer:
                    <input type="text" name="streetNumber" id="streetNumber" required><br>
                </label>
                <label for="streetNumberAppendix">
                    Huisnummer toevoeging:
                    <input type="text" name="streetNumberAppendix" id="streetNumberAppendix"><br>
                </label>
                <label for="city">
                    Stad:
                    <input type="text" name="city" id="city" required><br>
                </label>
                <label for="country">
                    Land:
                    <input type="text" name="country" id="country" required><br>
                </label>
                <label for="password">
                    Wachtwoord:
                    <input type="password" name="password" id="password" required><br>
                </label>
                <label>
                    <input type="checkbox" name="newsletter">
                    Nieuwsbrief<br>
                    <input type="submit" value="Registreer" name="submit">
                </label>
            </form>
            <div>
            <?php
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
    
        $person = new Person($name, $email, $phone, $email, $dateOfBirth, $password, null);
    
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

 
    }
    ?>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.html", "header");
        includeHTML("footer.html", "footer");
    </script>
</body>

</html>