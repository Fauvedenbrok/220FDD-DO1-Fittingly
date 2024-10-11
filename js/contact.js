document.getElementById("contactForm").addEventListener("submit", function(event){
    event.preventDefault(); // Voorkomt dat het formulier standaard verstuurt

    let valid = true;
    const errors = document.querySelectorAll(".error");

    // Naam veld validatie
    const naam = document.getElementById("naam").value;
    if (naam === "") {
        errors[0].textContent = "Naam is verplicht.";
        valid = false;
    } else {
        errors[0].textContent = "";
    }

    // Bedrijf veld validatie
    const bedrijf = document.getElementById("bedrijf").value;
    if (bedrijf === "") {
        errors[1].textContent = "Bedrijf is verplicht.";
        valid = false;
    } else {
        errors[1].textContent = "";
    }

    // E-mail veld validatie
    const email = document.getElementById("email").value;
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        errors[2].textContent = "Voer een geldig e-mailadres in.";
        valid = false;
    } else {
        errors[2].textContent = "";
    }

    // Telefoon veld validatie
    const tel = document.getElementById("tel").value;
    if (tel === "") {
        errors[3].textContent = "Telefoonnummer is verplicht.";
        valid = false;
    } else {
        errors[3].textContent = "";
    }

    // Bericht veld validatie
    const bericht = document.getElementById("bericht").value;
    if (bericht === "") {
        errors[4].textContent = "Bericht is verplicht.";
        valid = false;
    } else {
        errors[4].textContent = "";
    }

    if (valid) {
        document.getElementById("send").textContent = "Formulier succesvol verstuurd!";
        // Hier kun je eventueel een AJAX-aanroep toevoegen om de gegevens naar de server te sturen
    } else {
        document.getElementById("send").textContent = "Corrigeer de fouten en probeer opnieuw.";
    }
});