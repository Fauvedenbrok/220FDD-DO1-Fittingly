function showCartPopup(x, y) {
    const popup = document.getElementById('cart-popup');

    // Popup net boven de muispositie laten verschijnen
    popup.style.left = `${x}px`;
    popup.style.top = `${y - 40}px`; // 40px boven muispositie
    popup.style.position = 'absolute';
    
    popup.classList.remove('hidden');
    popup.classList.add('show');

    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 3000); // Popup verdwijnt na 3 seconden
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-form button').forEach(button => {
        button.addEventListener('click', (event) => {
            const x = event.clientX;
            const y = event.clientY;
            showCartPopup(x, y);
        });
    });
});
