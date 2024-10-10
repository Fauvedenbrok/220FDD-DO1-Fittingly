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


/*Countdown timer */
const countdown = new Date('2024-11-11T12:00:00').getTime(); /*tijd tussen 1-1-1970 en de releasedatum van Fittingly*/
console.log(countdown);

const days = document.querySelector(".days span");
const hours = document.querySelector(".hours span");
const minutes = document.querySelector(".minutes span");
const seconds = document.querySelector(".seconds span");

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

    //Zodra de het verschil tussen nu en de releasedatum 0 bereikt, wordt alles op 00 gezet
    if (t.difference <= 0) {
        days.innerText = '00';
        hours.innerText = '00';
        minutes.innerText = '00';
        seconds.innerText = '00';
        clearInterval(timeinterval);
    }
}

function smoothTransition(){
    const elementArray = [days, hours, minutes, seconds];

    elementArray.forEach(element => {
        element.style.transition = 'all 0.5s ease-in-out'; 
    });
    
}

function initializeTimer() {
    updateTimer();  // Het updaten van de timer
    smoothTransition();  // transitie van de cijfers
    const timeInterval = setInterval(updateTimer, 1000);  // iedere seconde wordt dit uitgevoerd
}

initializeTimer();



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
