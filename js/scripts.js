"use strict";

function changeNav(){
  // toggled een css class bij het element 'nav' in de header. 
  // Als de class is toegevoegd wordt de navigatie zichtbaar en anders verdwijnt die weer.
  document.querySelector('header nav').classList.toggle('visible');

};

function includeHTML(source, dst) {
  fetch(source)
    .then(response => response.text())
    .then(data => {
      document.querySelector(dst).innerHTML = data;
    })
    .catch(error => console.error('Error fetching the menu: ', error))
}


// function toggleDarkLight {
  
// }