/**
 * partnerPaginaScripts.js
 *
 * Handles interactive features for the partner page.
 * - Toggles the pressed state of the sign-up button.
 * - (Commented out) Functions for toggling dark/light mode.
 *
 * Functions:
 * - pushButton(): Toggles the 'aanmeld-button-pressed' class on the sign-up button.
 * - toggleDarkLight(): (Commented out) Switches between dark and light mode for elements.
 */

//Aanmeldknop class switch functie
function pushButton() {
var bPush = document.querySelector(".aanmeld-button")
bPush.classList.toggle("aanmeld-button-pressed")
}


// function toggleDarkLight() {
//     var toggleDL = document.getElementById("toggleDarkAndLight")
//     toggleDL.classList.toggle("lightMode")
//     console.log(toggleDL)
// }


// function toggleDarkLight() {
//     var toggleDL = document.getElementsByClassName("darkMode")
//     console.log(toggleDL)
//     for (let i = 0; i < toggleDL; i++) 
//         {
//         toggleDL[i].classList.toggle("lightMode")
//     }

// }