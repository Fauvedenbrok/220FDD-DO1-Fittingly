const sliderImages = document.querySelectorAll('.slider-image');
// Gebruik const (constant) wanneer je zeker weet dat een variabele niet verandert.
let currentIndex = 0;
// Gebruik let wanneer een variabele binnen een blok moet veranderen of wanneer de waarde kan variëren.
const totalImages = sliderImages.length;


        // Immediately check if the page was loaded via hard refresh
var navigationEntries = performance.getEntriesByType("navigation");
var isHardRefresh = navigationEntries.length && navigationEntries[0].type === 'reload';

        // Show splash screen only on hard refresh
if (isHardRefresh) {
    // Show splash screen
    document.querySelector(".splash-screen").style.visibility = "visible";
} else {
            // Skip splash screen
    document.querySelector(".splash-screen").style.visibility = "hidden";
    document.querySelector("header").classList.add("visible"); // Show header immediately
    document.querySelector(".main-content").classList.add("visible"); // Show main content immediately
}
document.addEventListener("DOMContentLoaded", function() {
    var splashScreen = document.querySelector(".splash-screen");
    var mainContent = document.querySelector(".main-content");
    var header = document.querySelector("header");

// Show splash screen only on hard refresh
  if (isHardRefresh) {
    setTimeout(function() {
        // Hide the splash screen after the animation completes
        splashScreen.style.visibility = "hidden"; // Make it invisible
        splashScreen.style.height = "0";          // Collapse the height

        // Show main content
        header.classList.add("visible"); // Make header visible
        mainContent.classList.add("visible");     // Add class to show main content
    },3500); // Duration for splash screen
} else {
    // Skip the splash screen on internal navigation
    splashScreen.style.visibility = "hidden";  // Make it invisible
    splashScreen.style.height = "0";           // Collapse the height
    header.classList.add("visible");           // Make header visible
    mainContent.classList.add("visible");      // Show main content immediately
}
});


document.addEventListener('DOMContentLoaded', function() {
    const sliderImages = document.querySelectorAll('.slider-image');

    function getTranslateX(image) {
        var style = window.getComputedStyle(image);
        var matrix = new WebKitCSSMatrix(style.transform);
        // console.log('translateX: ', matrix.m41);
        return matrix.m41;
    }

    // function getImageWidth(image){
    //     var style = window.getComputedStyle(image);
    //     var width = style.getPropertyValue('width');
    //     return width;
    // }

    function initializeSlider() {
        sliderImages.forEach((image, index) => {
            image.style.transform = `translateX(${((index) * 120)}px)`;
        });
    }

    function updateSlider() {
        sliderImages.forEach((image, index) => {
            if (index <= 2 && (getTranslateX(image) < -840)) {
                image.style.display = 'none';
                image.style.transform = `translateX(${getTranslateX(image) + 7560}px)`;
                image.style.display = "";
            }
            else if (index > 2 && (getTranslateX(image) < (index * -360))) {
                image.style.display = 'none';
                // positioneer de afbeelding aan de rechterkant van het scherm
                image.style.transform = `translateX(${getTranslateX(image) + (index * -360) + 8400}px)`;
                image.style.display = "";
            }
            else {
                image.style.transform = `translateX(${getTranslateX(image) - 120}px)`;
            }
        });
    }

    // Start de slider zodra de pagina geladen is
    initializeSlider();
    setInterval(updateSlider, 3000);
    setInterval(initializeSlider, 216000);
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

// Sla de originele tekst op
const paragraphText = document.querySelector('.index-paragraph-tekst-2');
const originalText = paragraphText ? paragraphText.textContent : '';  // Controleer of de paragraaf bestaat

let lastClickedItem = null; // Houdt bij welk item het laatst is aangeklikt

usp1LightImage.addEventListener('click', function () {
    if (paragraphText) {
        // Check of dit het item is dat twee keer achter elkaar wordt geklikt
        if (lastClickedItem === usp1LightImage) {
            // Als dit hetzelfde item is, zet de originele tekst terug
            paragraphText.textContent = originalText;
            paragraphText.classList.remove('color-1', 'color-2', 'color-3');
            lastClickedItem = null; // Reset de laatste klik
        } else {
            // Verander de tekst voor USP1 en voeg de juiste class toe
            paragraphText.textContent = 'Nieuwe tekst voor USP1 Light knop.';
            paragraphText.classList.add('color-1');
            paragraphText.classList.remove('color-2', 'color-3');
            lastClickedItem = usp1LightImage; // Sla dit item op als het laatst aangeklikte
        }
    }
});

usp2LightImage.addEventListener('click', function () {
    if (paragraphText) {
        if (lastClickedItem === usp2LightImage) {
            paragraphText.textContent = originalText;
            paragraphText.classList.remove('color-1', 'color-2', 'color-3');
            lastClickedItem = null;
        } else {
            paragraphText.textContent = 'Nieuwe tekst voor USP2 Light knop.';
            paragraphText.classList.add('color-2');
            paragraphText.classList.remove('color-1', 'color-3');
            lastClickedItem = usp2LightImage;
        }
    }
});

usp3LightImage.addEventListener('click', function () {
    if (paragraphText) {
        if (lastClickedItem === usp3LightImage) {
            paragraphText.textContent = originalText;
            paragraphText.classList.remove('color-1', 'color-2', 'color-3');
            lastClickedItem = null;
        } else {
            paragraphText.textContent = 'Nieuwe tekst voor USP3 Light knop.';
            paragraphText.classList.add('color-3');
            paragraphText.classList.remove('color-1', 'color-2');
            lastClickedItem = usp3LightImage;
        }
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
