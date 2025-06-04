function showCartPopup() {
    const popup = document.getElementById('cart-popup');
    popup.classList.remove('hidden');
    popup.classList.add('show');

    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 2000); // Popup verdwijnt na 2 seconden
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-form button').forEach(button => {
        button.addEventListener('click', () => {
            showCartPopup();
        });
    });
});
