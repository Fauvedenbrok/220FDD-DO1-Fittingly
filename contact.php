<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fittingly/Contact</title>
    <link rel="icon" href="/Images/icons/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <header></header>
    <main>
        <div class="background-container">
            <h2 id="h2-contact">Contact</h2>
            <p id="para-contact">Benieuwd naar de mogelijkheden? Meld je aan en verhuur jouw exclusieve kleding via ons
                platform, terwijl je bijdraagt aan een duurzame toekomst. </p>
        </div>

        <div class="form-container">
            <div class="contact-info">
                <h3 id="h3-contact">Contactinformatie</h3>
                <p><img id="usp1-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Address: Straat
                    123, 1021 AB, Breda</p>
                <p><img id="usp2-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Telefoon:
                    +31631506081</p>
                <p><img id="usp3-contact" src="/Images/backgroundImages/usp_Fittingly_dark.png" alt="usp">Email:
                    info@fittingly.nl</p>
            </div>
            <form id="contact-form">
                <div class="form-content">
                    <div class="input-fields">
                        <label for="naam">Naam:</label>
                        <input type="text" id="naam" placeholder="Naam">
                        <small class="error"></small>

                        <label for="bedrijf">Bedrijf:</label>
                        <input type="text" id="bedrijf" placeholder="Bedrijf">
                        <small class="error"></small>

                        <label for="email">E-mailAddress:</label>
                        <input type="text" id="email" placeholder="E-mailAddress" autocomplete="off">
                        <small class="error"></small>

                        <label for="tel">Telefoonnummer:</label>
                        <input type="text" id="tel" placeholder="Telefoonnummer" autocomplete="off">
                        <small class="error"></small>

                        <div class="input-bericht">
                            <label for="bericht">Bericht:</label>
                            <textarea id="bericht" placeholder="Bericht" rows="12"></textarea>
                            <small class="error"></small>
                        </div>
                        <div class="button-wrapper">
                            <button class="button-container" type="submit" value="Verzenden">Aanmelden</button>
                        </div>
                        <p id="send"></p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer></footer>
    <script src="js/scripts.js"></script>
    <script>
        includeHTML("header.php", "header");
        includeHTML("footer.php", "footer")
    </script>
    <script src="js/contact.js"></script>
</body>

</html>