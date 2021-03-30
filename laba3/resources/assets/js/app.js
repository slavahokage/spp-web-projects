/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import Router from 'vue-router';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Articles from './components/Articles.vue';


Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('articles', require('./components/Articles.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));

Vue.use(Router);

const router = new Router({
    routes: [
        { path: '/', component: Articles },
        { path: '/login', component: Login },
        { path: '/register', component: Register },
    ]
});

const app = new Vue({
    router
}).$mount('#app');
