/**
 * cart-popup.js
 *
 * Handles the display of a temporary popup when a product is added to the cart.
 * - Shows a popup above the mouse click position and hides it automatically after 2 seconds.
 * - Listens for form submissions on forms with the class 'add-to-cart-form'.
 * - Submits the form data using fetch() instead of a classic form submission.
 * - Ensures the popup appears at the correct button position.
 *
 * Functions:
 * - showCartPopup(x, y): Displays the popup at the specified (x, y) coordinates.
 *
 * Event Listeners:
 * - On DOMContentLoaded: Adds submit event listeners to all '.add-to-cart-form' forms.
 *   Prevents default form submission, sends data via fetch, and shows the popup on success.
 */
function showCartPopup(x, y) {
    const popup = document.getElementById('cart-popup');
    popup.style.left = `${x}px`;
    popup.style.top = `${y - 40}px`; // 40px above the click position
    popup.style.position = 'absolute';

    // Show popup
    popup.classList.remove('hidden');
    popup.classList.add('show');

    // Hide popup automatically after 2 seconds
    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 2000);
}

/**
 * Waits for the DOM to be fully loaded.
 * Then finds all forms with the class 'add-to-cart-form'
 * and adds an event listener to each form to submit via fetch() instead of a classic form submission.
 */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        const button = form.querySelector('button');

        // When the form is submitted (by clicking the button)
        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // prevent page reload

            // Determine the position of the button for the popup
            const x = event.submitter?.getBoundingClientRect().left + window.scrollX ?? 0;
            const y = event.submitter?.getBoundingClientRect().top + window.scrollY ?? 0;

            // Collect the form data
            const formData = new FormData(form);

            // Simulate sending the button's name and value (like 'add_to_cart'),
            // since this does not happen automatically with fetch + FormData
            if (event.submitter?.name) {
                formData.append(event.submitter.name, event.submitter.value ?? "");
            }

            try {
                // Send the form via fetch to the specified PHP file (e.g., cart.php)
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                // If the response is successful (HTTP 200), show popup
                if (response.ok) {
                    showCartPopup(x, y);
                } else {
                    // Show an error in the console if something goes wrong with the request
                    console.error('Fout bij toevoegen aan winkelwagen:', await response.text());
                }
            } catch (error) {
                // Log network errors (e.g., server offline)
                console.error('Netwerkfout:', error);
            }
        });
    });
});
