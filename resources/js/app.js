/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2'
import store from './store'
import Gate from './Gate.js'

Vue.use(VueRouter);
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

Vue.prototype.$gate = new Gate(window.userRole); // windows.userRole was set in master.blade.php before </body>

window.Swal = Swal;

const routes = [
    { path: '/', name: 'Dashboard', component: require('./components/pages/Dashboard.vue').default },
    { path: '/attendance', name: 'Attendance', component: require('./components/pages/Attendance.vue').default },
    { path: '/book-entry', name: 'BookEntry', component: require('./components/pages/BookEntry.vue').default },
    { path: '/issued-return', name: 'IssuedReturn', component: require('./components/pages/IssuedReturn.vue').default },
    { path: '/borrowers', name: 'Borrowers', component: require('./components/pages/Borrowers.vue').default },
    { path: '/user-management', name: 'UserManagement', component: require('./components/pages/UserManagement.vue').default },
    { path: '/audit-log', name: 'AuditLog', component: require('./components/pages/AuditLog.vue').default },
    { path: '/reports', name: 'Reports', component: require('./components/pages/Reports.vue').default },
    { path: '/settings', name: 'Settings', component: require('./components/pages/Settings.vue').default },
    { path: '/*', name: 'NotFound', component: require('./components/pages/NotFound.vue').default }
];

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('not-found', require('./components/pages/NotFound.vue').default);
Vue.component('forbidden-page', require('./components/pages/ForbiddenPage.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

const app = new Vue({
    router,
    el: '#app',
    store,
});
