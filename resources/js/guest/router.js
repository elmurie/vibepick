import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import Home from './pages/Home';
import AdvancedSearch from './pages/AdvancedSearch';
import NotFound from './pages/NotFound';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/instruments/:slug',
            name: 'search',
            component: AdvancedSearch
        },
        {
            path: '/*',
            name: '404',
            component: NotFound
        }
    ],
});

export default router;