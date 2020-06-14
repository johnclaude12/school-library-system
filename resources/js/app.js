/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2'
import store from './store'
import Gate from './Gate.js'
import router from './router/index.js'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

Vue.prototype.$gate = new Gate(window.userRole); // windows.userRole was set in master.blade.php before </body>

window.Swal = Swal;

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('not-found', require('./components/pages/NotFound.vue').default);
Vue.component('forbidden-page', require('./components/pages/ForbiddenPage.vue').default);

const app = new Vue({
    router,
    el: '#app',
    store,
});
