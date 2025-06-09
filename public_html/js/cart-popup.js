function showCartPopup(x, y) {
    const popup = document.getElementById('cart-popup');
    popup.style.left = `${x}px`;
    popup.style.top = `${y - 40}px`; // 40px boven cursor
    popup.style.position = 'absolute';

    popup.classList.remove('hidden');
    popup.classList.add('show');

    setTimeout(() => {
        popup.classList.remove('show');
        popup.classList.add('hidden');
    }, 2000);
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-form button').forEach(button => {
        button.addEventListener('click', (event) => {
            const x = event.pageX;
            const y = event.pageY;
            showCartPopup(x, y);
        });
    });
});
