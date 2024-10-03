"use strict";

// functie om een html bestand te 'importeren' in een ander html script
function includeHTML(attribute) {
    var z, elmnt, file, xhttp;
    // z pakt alle element selectors
    z = document.getElementsByTagName("*");
    // per element in de array 'z' wordt gekeken of het 'atrribute' aanwezig is
    for (let i = 0; i < z.length; i++) {
      elmnt = z[i];
      file = elmnt.getAttribute(attribute);
      // bij een element waar het 'attribute' aanwezig is wordt de JS class 'XMLHttpRequest' gemaakt
      // uitleg XMLHttpRequest: https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
      if (file) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          // hier wordt gecontroleerd wat de status van de XMLHttpRequest is
          if (this.readyState == 4) {
            // status 200 is dat dit goed is en 404 is dat het bestand niet gevonden kan worden.
            if (this.status == 200) {elmnt.innerHTML = this.responseText;}
            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
            elmnt.removeAttribute(attribute);
            includeHTML();
          }
        }
        // haal de inhoud van het html bestand op
        xhttp.open("GET", file, true);
        // stuurt de html naar waar het is aangegeven in het script
        xhttp.send();
        // sluit de functie af
        return;
      }
    }
  }


