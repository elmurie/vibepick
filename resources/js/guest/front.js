window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

import App from './App';
import router from './router';

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

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