"use strict";

/**
 * scripts.js
 *
 * Handles general UI interactions for the Fittingly website.
 * - Toggles navigation and language dropdowns.
 * - Toggles the account menu visibility.
 * - Dynamically includes HTML fragments into the page (e.g., header, footer).
 *
 * Functions:
 * - changeNav(): Toggles the visibility of the navigation menu.
 * - changeLang(): Toggles the visibility of the language dropdown.
 * - toggleAccountMenu(): Toggles the visibility of the account dropdown menu.
 * - includeHTML(source, dst): Loads HTML from a source file and inserts it into the destination element.
 */

/**
 * Toggles the visibility of the navigation menu in the header.
 */
function changeNav(){
  // toggled een css class bij het element 'nav' in de header. 
  // Als de class is toegevoegd wordt de navigatie zichtbaar en anders verdwijnt die weer.
  document.querySelector('header nav').classList.toggle('visible');

};

/**
 * Toggles the visibility of the language dropdown menu.
 */
function changeLang() {
  // Selecteer het dropdown-menu
  const dropdown = document.getElementById('language-dropdown');
  
  // Toggle de 'visible'-klasse
  dropdown.classList.toggle('visible');
}

/**
 * Toggles the visibility of the account dropdown menu.
 */
function toggleAccountMenu() {
  // Toggle de 'visible' class op het account-menu
  const menu = document.getElementById('account-menu');
  if (menu) {
    menu.classList.toggle('visible');
  }
}

/**
 * Dynamically loads HTML from a source file and inserts it into the destination element.
 *
 * @param {string} source - The path to the HTML file to include.
 * @param {string} dst - The CSS selector of the destination element.
 */
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