
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
require('iview');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('info-msg', require('./components/ExampleComponent.vue'));
Vue.component('left-menu', require('./components/LeftMeunComponent.vue'));


document.addEventListener("DOMContentLoaded", function() {
  var pjax = new Pjax({
    elements: 'a',
    selectors: ['#content'],
    // currentUrlFullReload: true,
  })
});
