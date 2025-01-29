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
    // de php functie 'include' takes all the text/code/markup that exists in the specified file and copies it into the file that uses the include statement. 
    // Including files is very useful when you want to include the same PHP, HTML, or text on multiple pages of a website.
    // In dit geval wordt het gebruikt voor de model klassen.
    include("Models/Person.php");
    include("Models/Address.php");
    include("Models/Message.php");
    include("Models/Customer.php");

    // met de isset functie wordt hier gecontroleerd of de button met het name attribuut 'submit' is aangeklikt.
    // Dit doet die door te controleren of in de Array $_POST de key 'submit' een waarde heeft.
    if(isset($_POST["submit"])){
        // als de button is aangeklikt, maken we variabelen aan waarin we de waardes stoppen. De $_POST['*'] *= name attribuut van de inputfields. 
        // Deze zijn opgeslagen als key-value pairs in de $_POST array.
        $newsletter = null;  
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $password = $_POST["password"];
    
        // Hier wordt een object van de Klasse Person gemaakt en opgeslagen in de variabele '$person'
        // Om een object van de Klasse aan te maken, maak je gebruik van de contructor in de Klasse. (__construct(....))
        // Het is belangrijk om alle variabele in te vullen die ook in de constructor staan, en op dezelfde volgorde.
        $person = new Person($name, $email, $phone, $email, $dateOfBirth, $password, null);
    
        // Voor het aanmaken van een object hoef je niet persé de input eerst in een variabele te stoppen maar,
        // dit is wel aan te raden als je nog meer controles zou willen uitvoeren op de binnenkomende data.
        $address = new Address($_POST['postalCode'],
        $_POST['streetName'],
        $_POST['streetNumber'],
        $_POST['streetNumberAppendix'],
        $_POST['city'],
        $_POST['country']);

        // Hier wordt het object van de Klasse Address, opgeslagen in de variabele address in het Person object. 
        // Dit kan alleen op deze manier als de variabele address public is in de Klasse.
        // Variabele die public zijn in een Klasse zijn makkelijker te beïnvloeden maar kunnen ook een risico vormen. Dit kan je omzeilen door een aparte functie hiervoor te maken.
        $person->address = $address;

        // Staat verder uitgelegd in Message.php
        $message = new Message($person->getName(), "Thank you for registering!", "Kind regards,<br>Fittingly");

        // Als de waarde van $_POST["newsletter"], niet null is dan wordt die true, anders wordt die false.
        if(isset($_POST["newsletter"])){
            $newsletter = true;
        }
        else{
            $newsletter = false;
        }

        // echo laat de waarde tussen "" zien op je website.
        echo"<br>";
        // hier wordt de functie __ToString() van de Klasse Person en daarna van de Klasse Address gebruikt om data te laten zien.
        echo $person . " and " . $person->address;
        echo "<br>";
        echo "<br>";
        // Hier wordt de functie __ToString() van de Klasse Message gebruikt om data te laten zien.
        echo $message;
        echo "<br>";
        echo "<br>";
        // Hier wordt de functie getPassword() van de Klasse Person gebruikt.
        echo $person->getPassword();

        echo $person->$name;
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