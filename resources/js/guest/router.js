import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import Home from './pages/Home';
import AdvancedSearch from './pages/AdvancedSearch';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/search/:select',
            name: 'search',
            component: AdvancedSearch
        }
    ],
});

export default router;