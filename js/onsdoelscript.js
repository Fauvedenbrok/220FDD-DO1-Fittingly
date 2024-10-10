const sliderImages = document.querySelectorAll('.slider-image');
let currentIndex = 0;
const totalImages = sliderImages.length;

// Functie om de slider te updaten
function updateSlider() {
    // Verberg alle afbeeldingen
    sliderImages.forEach((image, index) => {
        image.style.transform = `translateX(${(index - currentIndex) * 100}%)`;
    });
}

// Functie om de volgende afbeelding te tonen
function showNextImage() {
    currentIndex = (currentIndex + 1) % totalImages; // Ga naar de volgende afbeelding
    updateSlider();
}

// Start de automatische slideshow
setInterval(showNextImage, 3000); // Verander afbeelding elke 3 seconden

// Toggle Light/Dark mode
const modeToggleButton = document.getElementById('mode-toggle');
let isLightMode = false;

modeToggleButton.addEventListener('click', () => {
    if (isLightMode) {
        document.body.style.backgroundColor = '#1A3030';
        document.body.style.color = '#DCD3C2';
        modeToggleButton.textContent = 'Light Mode';
        document.querySelector('h2').style.color = '#CC9C4E'; // Gouden kleur voor h2
    } else {
        document.body.style.backgroundColor = '#DCD3C2'; // Achtergrondkleur voor light mode
        document.body.style.color = '#3A3B33'; // Tekstkleur voor light mode
        modeToggleButton.textContent = 'Dark Mode';
        document.querySelector('h2').style.color = '#B3AD98'; // Kleur voor h2 in light mode
    }
    isLightMode = !isLightMode; // Toggle mode
});

document.addEventListener('DOMContentLoaded', () => {
    updateSlider(); // Update de slider bij het laden van de pagina
});
