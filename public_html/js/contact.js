//selecteerd het element met de id 'contactForm' en gaat daarna na of de button met type"submit" is ingeklikt.
document
	.getElementById('contact-form')
	.addEventListener('submit', function (event) {
		event.preventDefault() // Voorkomt dat het formulier standaard verstuurt

		// geeft de Boolean waarde 'true' aan het variabele 'valid'
		let valid = true
		// maakt een Array van alle velden met de class error
		const errors = document.querySelectorAll('.error')

		// Naam veld validatie
		// naam krijgt de waarde die ingevuld is in het inputveld met de id 'naam'
		const naam = document.getElementById('naam').value
		// als het variabele 'naam' leeg is: wordt er in de eerste key-element van de 'errors' array de tekst "Naam is verplicht" gezet. de waarde van 'valid' wordt 'false'
		if (naam === '') {
			errors[0].textContent = 'Naam is verplicht.'
			valid = false
			// anders: blijft de waarde van 'valid', 'true' en komt blijft de tekst in de eerste key-element van de 'errors' array leg.
		} else {
			errors[0].textContent = ''
		}

		// Bedrijf veld validatie
		const bedrijf = document.getElementById('bedrijf').value
		if (bedrijf === '') {
			errors[1].textContent = 'Bedrijf is verplicht.'
			valid = false
		} else {
			errors[1].textContent = ''
		}

		// E-mail veld validatie
		const email = document.getElementById('email').value
		// de waarde van emailPattern = (één of meerdere tekens)@(één of meerdere tekens).(2 tot 3 tekens waarbij alleen tekens in het alfabet mogen.)
		const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/
		if (!email.match(emailPattern)) {
			errors[2].textContent = 'Voer een geldig e-mailAddress in.'
			valid = false
		} else {
			errors[2].textContent = ''
		}

		// Telefoon veld validatie
		const tel = document.getElementById('tel').value
		const telRegex = /^[0-9+]+$/ // Alleen nummers en het + teken
		if (tel === '') {
			errors[3].textContent = 'Telefoonnummer is verplicht.'
			valid = false
		} else if (!telRegex.test(tel)) {
			errors[3].textContent =
				'Ongeldig telefoonnummer. Alleen cijfers en het + teken zijn toegestaan.'
			valid = false
		} else {
			errors[3].textContent = ''
		}

		// Bericht veld validatie
		const bericht = document.getElementById('bericht').value
		if (bericht === '') {
			errors[4].textContent = 'Bericht is verplicht.'
			valid = false
		} else {
			errors[4].textContent = ''
		}

		// // als de waarde van valid nog steeds 'true' is, komt er een pop-up met de tekst: "Formulier succesvol verstuurd!"
		// if (valid) {
		//     document.getElementById("send").textContent = window.alert("Formulier succesvol verstuurd!");
		//     // Hier kun je eventueel een AJAX-aanroep toevoegen om de gegevens naar de server te sturen

		//     // als valid 'false' is, komt er een pop-up met de tekst: "Corrigeer de fouten en probeer opnieuw."
		// } else {
		//     document.getElementById("send").textContent = window.alert("Corrigeer de fouten en probeer opnieuw.");
		// }
	})
