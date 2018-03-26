/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueTheMask from 'vue-the-mask';
Vue.use(VueTheMask);

Vue.component('wishlist', require('./components/wishlist.vue'));
Vue.component('addcart', require('./components/addcart.vue'));
Vue.component('cart', require('./components/cart.vue'));
Vue.component('profile', require('./components/profile.vue'));
Vue.component('review', require('./components/review.vue'));

const app = new Vue({
  el: '#app'
});
