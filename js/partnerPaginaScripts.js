//Aanmeldknop class switch functie
function pushButton() {
var bPush = document.querySelector(".aanmeldButton")
bPush.classList.toggle("aanmeldButtonPressed")
}

function toggleDarkLight() {
    var toggleDL = document.getElementsByClassName("darkMode")
        toggleDL.classList.toggle("lightMode")
    console.log(toggleDL)
}