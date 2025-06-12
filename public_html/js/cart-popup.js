// Simpele popup weergave
function showCartPopup(x, y) {
    const popup = document.getElementById('cart-popup');
    if (!popup) return;
    
    // Positionering
    popup.style.left = x + 'px';
    popup.style.top = (y - 40) + 'px';
    popup.style.position = 'fixed';
    
    // Zichtbaar maken
    popup.classList.remove('hidden');
    popup.classList.add('show');
    
    // Na 2 seconden verbergen
    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 2000);
}

// Functie om het totaalbedrag bij te werken
function updateCartTotal(total) {
    const totalElement = document.querySelector('.cart-total');
    if (totalElement) {
        totalElement.textContent = `€${parseFloat(total).toFixed(2)}`;
    }
}

// Functie om een artikel te verwijderen uit de weergave
function removeArticleRow(articleId) {
    const row = document.querySelector(`tr[data-article-id="${articleId}"]`);
    if (row) {
        row.remove();
    }
}

// Functie om winkelwagen te updaten zonder pagina te herladen
async function updateCartDisplay() {
    try {
        const response = await fetch('cart_controller.php?format=json');
        if (!response.ok) return;
        
        const cartData = await response.json();
        
        // Update totaal
        updateCartTotal(cartData.total);
        
        // Controleer of de winkelwagen leeg is
        if (cartData.items.length === 0) {
            document.querySelector('.cart-form')?.remove();
            document.querySelector('.cart-empty').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Fout bij ophalen winkelwagen:', error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const controllerUrl = 'cart_controller.php';
    
    // Muispositie bijhouden
    let mouseX = 0;
    let mouseY = 0;
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    // Toevoegen aan winkelwagen
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            formData.append('add_to_cart', '1');
            
            try {
                const res = await fetch(controllerUrl, {
                    method: 'POST',
                    body: formData
                });
                
                if (res.ok) {
                    showCartPopup(mouseX, mouseY);
                }
            } catch (error) {
                console.error('Fout:', error);
            }
        });
    });

// Verwijderen uit winkelwagen
document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const articleId = btn.dataset.removeId;
        
        try {
            // Verzend verwijderverzoek
            const formData = new FormData();
            formData.append('remove_product_id', articleId);
            
            const res = await fetch(controllerUrl, {
                method: 'POST',
                body: formData
            });
            
            if (res.ok) {
                // Toon bevestiging
                alert('Artikel verwijderd!');
                
                // Verwijder de rij onmiddellijk
                removeArticleRow(articleId);
                
                // Update de winkelwagenweergave
                await updateCartDisplay();
            }
        } catch (error) {
            console.error('Fout:', error);
        }
    });
});

    // Updaten hoeveelheden
const updateBtn = document.getElementById('update-btn');
if (updateBtn) {
  updateBtn.addEventListener('click', async (e) => {
    e.preventDefault();  // voorkomt een onbedoelde submit

    const form = document.getElementById('cart-form');
    const formData = new FormData(form);

    // **Nieuw:** geef aan dat dit een update-verzoek is**
    formData.append('update_cart', '1');

try {
  const res = await fetch(controllerUrl, {
    method: 'POST',
    body: formData
  });
  if (res.ok) {
    // Toon een melding dat het gelukt is
    alert('Aantal bijgewerkt!');
    
    // Daarna pas herladen
    location.reload();
  } else {
    console.error('Update mislukt:', await res.text());
  }
} catch (err) {
  console.error('Fetch error:', err);
}
  });
}
    
    // Afrekenknop
    const checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            window.location.href = 'checkout.php';
        });
    }
});