const sliderImages = document.querySelectorAll('.slider-image');
// Gebruik const (constant) wanneer je zeker weet dat een variabele niet verandert.
let currentIndex = 0;
// Gebruik let wanneer een variabele binnen een blok moet veranderen of wanneer de waarde kan variëren.
const totalImages = sliderImages.length;

document.addEventListener('DOMContentLoaded', function() {
    const sliderImages = document.querySelectorAll('.slider-image');
    let currentIndex = 3;
    const totalImages = sliderImages.length;

    function updateSlider() {
        sliderImages.forEach((image, index) => {
            image.style.transform = `translateX(${(index - currentIndex) * 75}%)`;
        });
    }

    function showNextImage() {
        currentIndex = (currentIndex + 1) % totalImages;
        updateSlider();
    }

    // Start de slider zodra de pagina geladen is
    updateSlider();
    setInterval(showNextImage, 3000);
});

const usp1LightImage = document.querySelector('img[alt="USP1Light"]');
const usp2LightImage = document.querySelector('img[alt="USP2Light"]');
const usp3LightImage = document.querySelector('img[alt="USP3Light"]');

usp1LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph4Tekst');
    
    if (paragraphText) {
        // Toggle de class 'color-1' op de specifieke paragraaf
        paragraphText.classList.toggle('color-1');
        // Verwijder andere kleuren classes
        paragraphText.classList.remove('color-2', 'color-3');
    }
});

usp2LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph4Tekst');
    
    if (paragraphText) {
        // Toggle de class 'color-2' op de specifieke paragraaf
        paragraphText.classList.toggle('color-2');
        // Verwijder andere kleuren classes
        paragraphText.classList.remove('color-1', 'color-3');
    }
});

usp3LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph4Tekst');
    
    if (paragraphText) {
        // Toggle de class 'color-3' op de specifieke paragraaf
        paragraphText.classList.toggle('color-3');
        // Verwijder andere kleuren classes
        paragraphText.classList.remove('color-1', 'color-2');
    }
});


// Toggle Light/Dark mode
// const modeToggleButton = document.getElementById('mode-toggle');
// let isLightMode = false;
// modeToggleButton.addEventListener('click', () => {
//     if (isLightMode) {
//         document.body.style.backgroundColor = '#1A3030';
//         document.body.style.color = '#DCD3C2';
//         modeToggleButton.textContent = 'Light Mode';
//         document.querySelector('h2').style.color = '#CC9C4E'; // Gouden kleur voor h2
//     } else {
//         document.body.style.backgroundColor = '#DCD3C2'; // Achtergrondkleur voor light mode
//         document.body.style.color = '#3A3B33'; // Tekstkleur voor light mode
//         modeToggleButton.textContent = 'Dark Mode';
//         document.querySelector('h2').style.color = '#B3AD98'; // Kleur voor h2 in light mode
//     }
//     isLightMode = !isLightMode; // Toggle mode
// });
