fetch('menu.html')
    .then(response => response.text())
    .then(data => {
        document.querySelector('nav').innerHTML = data;
    })
    .catch(error => console.error('Error fetching the menu:', error));

function includeHTML(dst, src) {
    fetch(src)
        .then(response => response.text())
        .then(data => {
            document.querySelector(dst).innerHTML = data;
        })
        .catch(error => console.error('Error fetching the menu:', error));
}