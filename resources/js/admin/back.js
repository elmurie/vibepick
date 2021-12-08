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

// Overlay toast aggiornamento profilo

const toast = document.getElementById('toast__vibe');
const toastBg = document.getElementById('bg__toast__vibe');

opacityToast = function() {
    toast.style.display = 'none'
    toastBg.style.display = 'none'
}