"use strict";

function changeNav(){

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