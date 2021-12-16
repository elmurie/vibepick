//Questa funzione verifica che sia stata selezionata almeno una checkbox agendo sull'attributo required del tag input

deRequireCb = function(elClass) {
    el=document.getElementsByClassName(elClass);

    var atLeastOneChecked=false;//Almeno una checkbox è stata selezionata
    for (i=0; i<el.length; i++) {
        if (el[i].checked === true) {
            atLeastOneChecked=true;
        }
    }

    if (atLeastOneChecked === true) {
        for (i=0; i<el.length; i++) {
            el[i].required = false;
        }
    } else {
        for (i=0; i<el.length; i++) {
            el[i].required = true;
        }
    }
}

// hamburger

const toggleMenu = document.getElementById('myLinksMobile');
const menuBtn = document.querySelector('.menu-btn');

let menuOpen = false;
menuBtn.addEventListener('click', () => {
    if(!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
        toggleMenu.style.display = "flex";
    } else {
        menuBtn.classList.remove('open');
        menuOpen = false;
        toggleMenu.style.display = "none";
    }
});