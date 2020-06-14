import Vue from "vue";
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes : [
        {
            path: '/',
            name: 'Dashboard',
            component: require('../components/pages/Dashboard.vue').default
        },
        {
            path: '/attendance',
            name: 'Attendance',
            component: require('../components/pages/Attendance.vue').default
        },
        {
            path: '/book-entry',
            name: 'BookEntry',
            component: require('../components/pages/Book/BookEntry.vue').default
        },
        {
            path: '/issued-return',
            name: 'IssuedReturn',
            component: require('../components/pages/IssuedReturn.vue').default
        },
        {
            path: '/borrowers',
            name: 'Borrowers',
            component: require('../components/pages/Borrowers.vue').default
        },
        {
            path: '/user-management',
            name: 'UserManagement',
            component: require('../components/pages/UserManagement.vue').default
        },
        {
            path: '/audit-log',
            name: 'AuditLog',
            component: require('../components/pages/AuditLog.vue').default
        },
        {
            path: '/reports',
            name: 'Reports',
            component: require('../components/pages/Reports.vue').default
        },
        {
            path: '/settings',
            name: 'Settings',
            component: require('../components/pages/Settings.vue').default
        },
        {
            path: '/*',
            name: 'NotFound',
            component: require('../components/pages/NotFound.vue').default
        }
    ]
});
