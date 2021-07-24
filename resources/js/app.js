/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('wine-list', require('./components/wine/ListWine').default);
Vue.component('wine-create', require('./components/wine/CreateWine').default);
Vue.component('wine-redirect', require('./components/wine/WineRedirect').default);
Vue.component('client-create', require('./components/client/CreateClient').default);
Vue.component('client-list', require('./components/client/ListClient').default);
Vue.component('address-list', require('./components/address/ListAddress').default);
Vue.component('address-create', require('./components/address/CreateAddress').default);
Vue.component('order-create', require('./components/order/CreateOrder').default);
Vue.component('order-list', require('./components/order/ListOrder').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


