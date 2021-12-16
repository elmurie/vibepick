import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import Home from './pages/Home';
import AdvancedSearch from './pages/AdvancedSearch';
import ShowArtist from './pages/ShowArtist';
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
            path: '/strumenti/:slug',
            children:[
                {
                    path: ':rewMin',
                    children: [
                        {
                            path: ':avgVote',
                        }
                    ],
                }
            ] ,
            name: 'search',
            component: AdvancedSearch,
            beforeEnter: (to, from, next) => {
                function isValid(param) {
                    axios.get(`api/instruments`)
                        .then((response) =>{
                            let nomi = response.data.data;
                            let solonomi = [];
                            nomi.forEach(elm => {
                                solonomi.push(elm.slug) 
                            });
                            if(!solonomi.includes(param)){
                                next({ path: '404' });
                            } else  {
                                next();
                            }
                        })
                }

                isValid(to.params.slug)

                
            }
        },

        {
            path: '/showartist/:id',
            name: 'ShowArtist',
            component: ShowArtist,
            beforeEnter: (to, from, next) => {
                function isValid(param) {
                    axios.get(`/showartist/api/showartist/${param}`)
                        .catch((error) => {
                            if(error.response.status == 500){
                                next({ path: '/404' });
                            } else {
                                next();
                            }
                        })
                }

                isValid(to.params.id)

                next();
            }
        },

        {
            path: '/*',
            name: '404',
            component: NotFound
        },
    ],
});

export default router;