/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./global/appReady');
require('./bootstrap');
require('vuejs-confirm-directive');

window.Vue = require('vue');

Vue.component('sidebar-toggle', require('./components/SidebarToggle.vue'));
Vue.component('task-group', require('./modules/Task/TaskGroup.vue'));

window.eventBus = new Vue({});

const app = new Vue({
  el: '#app'
});
