/**
 * Toont een tijdelijke pop-up op de pagina bij het toevoegen van een product aan de winkelwagen.
 * De pop-up verschijnt net boven de positie van de muisklik en verdwijnt automatisch na 2 seconden.
 */
function showCartPopup(x, y) {
    const popup = document.getElementById('cart-popup');
    popup.style.left = `${x}px`;
    popup.style.top = `${y - 40}px`; // 40px boven de klikpositie
    popup.style.position = 'absolute';

    // Pop-up zichtbaar maken
    popup.classList.remove('hidden');
    popup.classList.add('show');

    // Pop-up automatisch verbergen na 2 seconden
    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 2000);
}

/**
 * Wacht tot de DOM volledig is geladen.
 * Vervolgens zoekt het script alle formulieren met de class 'add-to-cart-form'
 * en voegt een event listener toe aan elk formulier om via fetch() te verzenden i.p.v. klassiek formulier.
 */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        const button = form.querySelector('button');

        // Wanneer het formulier wordt verzonden (via klikken op de knop)
        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // voorkom pagina-herlading

            // Bepaal de positie van de knop voor de popup
            const x = event.submitter?.getBoundingClientRect().left + window.scrollX ?? 0;
            const y = event.submitter?.getBoundingClientRect().top + window.scrollY ?? 0;

            // Verzamelt de gegevens van het formulier
            const formData = new FormData(form);

            // ✅ Simuleert het meesturen van de naam en waarde van de knop (zoals 'add_to_cart'),
            // want dit gebeurt niet automatisch bij gebruik van fetch + FormData
            if (event.submitter?.name) {
                formData.append(event.submitter.name, event.submitter.value ?? "");
            }

            try {
                // Verstuur het formulier via fetch naar het opgegeven PHP-bestand (bijv. Cart.php)
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                // Als de response succesvol is (HTTP 200), toon popup
                if (response.ok) {
                    showCartPopup(x, y);
                } else {
                    // Toon een foutmelding in de console als er iets misgaat met de request
                    console.error('Fout bij toevoegen aan winkelwagen:', await response.text());
                }
            } catch (error) {
                // Bij netwerkproblemen (zoals server offline), log fout
                console.error('Netwerkfout:', error);
            }
        });
    });
});
