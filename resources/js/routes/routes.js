import Vue from 'vue'
import VueRouter from 'vue-router'

import home from '../components/home.vue'
import hotelDetail from '../components/hotelDetail.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/hotel/test/',
        component: home,
        name: 'home'
    },
    {
        path: '/hotel/test/:id',
        component: hotelDetail,
        name: 'hotelDetail'
    }
];

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router;