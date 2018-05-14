/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'

Vue.use(VueRouter)

window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const ProductIndex = require('./components/catalogs/Index.vue')

 const routes = [
     {
         path: '/catalogs/:category',
         name: 'catalogs.index',
         component: ProductIndex,
     }
 ]

 const router = new VueRouter({
     mode: 'history',
     routes
 })

 router.beforeEach((to, from, next) => {
    document.title = to.params.category.replace(/\b\w/g, l => l.toUpperCase())

    next()
});

//
// import VueTheMask from 'vue-the-mask';
// Vue.use(VueTheMask);

// Vue.component('wishlist', require('./components/wishlist.vue'));
// Vue.component('addcart', require('./components/addcart.vue'));
Vue.component('cart', require('./components/cart.vue'));
// Vue.component('profile', require('./components/profile.vue'));
// Vue.component('review', require('./components/review.vue'));

const app = new Vue({
  el: '#app',
  router
});
