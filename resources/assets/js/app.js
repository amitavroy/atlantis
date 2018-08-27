/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./global/appReady');
require('./bootstrap');
require('./utils/globalUtils');
require('vuejs-confirm-directive');

window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('sidebar-toggle', require('./components/SidebarToggle.vue'));
Vue.component('task-group', require('./modules/Task/TaskGroup.vue'));
Vue.component('icon-widget', require('./components/IconWidget.vue'));
Vue.component('site-monitor', require('./components/SiteMonitor.vue'));
Vue.component('expense-add', require('./modules/Expense/ExpenseAdd.vue'));
Vue.component('expense-list', require('./modules/Expense/ExpenseList.vue'));
Vue.component('gallery-list', require('./modules/Gallery/GalleryList.vue'));
Vue.component('gallery-view', require('./modules/Gallery/GalleryView.vue'));

window.eventBus = new Vue({});

require('./socketEvents');

const app = new Vue({
  el: '#app'
});
