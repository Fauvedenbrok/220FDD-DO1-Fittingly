const sliderImages = document.querySelectorAll('.slider-image');
// Gebruik const (constant) wanneer je zeker weet dat een variabele niet verandert.
let currentIndex = 0;
// Gebruik let wanneer een variabele binnen een blok moet veranderen of wanneer de waarde kan variëren.
const totalImages = sliderImages.length;

document.addEventListener('DOMContentLoaded', function() {
    const sliderImages = document.querySelectorAll('.slider-image');
    let currentIndex = 1;
    const totalImages = sliderImages.length;

    function getTranslateX(image) {
        var style = window.getComputedStyle(image);
        var matrix = new WebKitCSSMatrix(style.transform);
        console.log('translateX: ', matrix.m41);
        return matrix.m41;
      }

    function initializeSlider() {
        sliderImages.forEach((image, index) => {
            image.style.transform = `translateX(${((index) * 120)}px)`;
        });
    }

    function updateSlider() {
        sliderImages.forEach((image, index) => {
            if(getTranslateX(image) < (index * -360)){
                // positioneer de afbeelding aan de rechterkant van het scherm
            image.style.transform = `translateX(${getTranslateX(image) + 8500}px)`;
            }
            else{
                image.style.transform = `translateX(${getTranslateX(image) - 120}px)`;
            }
        });
    }

    function showNextImage() {
        currentIndex = (currentIndex + 1) % totalImages;
        updateSlider();
    }

    // Start de slider zodra de pagina geladen is
    initializeSlider();
    setInterval(showNextImage, 3000);
});


/*Countdown timer */
const countdown = new Date('2024-11-11T12:00:00').getTime(); /*tijd tussen 1-1-1970 en de releasedatum van Fittingly*/
console.log("Countdown target time (in ms):", countdown);

const days = document.querySelector(".days span");
const hours = document.querySelector(".hours span");
const minutes = document.querySelector(".minutes span");
const seconds = document.querySelector(".seconds span");

let timeInterval;

//Het berekenen van de overgebleven dagen, uren, minuten en seconden
function getTimeRemaining(countdown) {
	const now = new Date().getTime(); //De Date() functie is altijd vandaag
	const difference = countdown - now;

	const days = Math.floor(difference / (1000 * 60 * 60 * 24));
	const hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
	const minutes = Math.floor((difference / 1000 / 60) % 60);
	const seconds = Math.floor((difference / 1000) % 60);

	return {
		difference,
		days,
		hours,
		minutes,
		seconds
	};
}

function updateTimer(countdown) {
    const t = getTimeRemaining(countdown); //Variabele die de return waarde uit de getTimeRemaining functie haalt

    //Controleert of de tijdwaardes een enkel cijfer bevatten. zo ja, dan wordt er een 0 voor gezet. Dit is voor de leesbaarheid
    days.innerText = t.days <= 9 ? '0' + t.days : t.days;
    hours.innerText = t.hours <= 9 ? `0` + t.hours : t.hours;
    minutes.innerText = t.minutes <= 9 ? `0` + t.minutes : t.minutes;
    seconds.innerText = t.seconds <= 9 ? `0` + t.seconds : t.seconds;
}

function initializeTimer() {
    setInterval(() => {
        getTimeRemaining(countdown);
        updateTimer(countdown);
    }, 1000);
}

initializeTimer();


//functie Freek

const usp1LightImage = document.querySelector('img[alt="USP1Light"]');
const usp2LightImage = document.querySelector('img[alt="USP2Light"]');
const usp3LightImage = document.querySelector('img[alt="USP3Light"]');

usp1LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph-tekst4');
    
    if (paragraphText) {
        // Toggle de class 'color-1' op de specifieke paragraaf
        paragraphText.classList.toggle('color-1');
        // Verwijder andere kleuren classes
        paragraphText.classList.remove('color-2', 'color-3');
    }
});

usp2LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph-tekst4');
    
    if (paragraphText) {
        // Toggle de class 'color-2' op de specifieke paragraaf
        paragraphText.classList.toggle('color-2');
        // Verwijder andere kleuren classes
        paragraphText.classList.remove('color-1', 'color-3');
    }
});

usp3LightImage.addEventListener('click', function() {
    const paragraphText = document.querySelector('.paragraph-tekst4');
    
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
