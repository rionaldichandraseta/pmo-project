
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueGoodTable from 'vue-good-table';
import Axios from 'axios';
import 'vue-good-table/dist/vue-good-table.css';
Vue.use(VueGoodTable);
Vue.use(Axios);

if (document.getElementById('pmo-page')) {
    const pmoPage = new Vue({
        el: '#pmo-page',
        components: {
            'pmo-main-page': require('./components/PMOMainPage.vue')
        }
    });
}

if (document.getElementById('admin-page')) {
    const adminPage = new Vue({
        el: '#admin-page',
        components: {
            'admin-main-page': require('./components/AdminPage.vue')
        }
    });
}