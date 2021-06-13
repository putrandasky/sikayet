/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
window.Vue = require('vue').default;
window.EventBus = new Vue();

window.Vue2 = require('vue').default;
window.Vue3 = require('vue').default;
Vue.use(BootstrapVue);
window.dayjs = require('dayjs');
Vue.mixin({
  methods: {
    toastSuccess: function(content) {
      this.$bvToast.toast(content, {
        title: `SUCCESS!`,
        headerClass: 'font-weight-bold',
        variant: 'success',
        solid: true,
        autoHideDelay: 1000,
        toaster: 'b-toaster-top-right'
      })
    },
    toastError: function(content) {
      this.$bvToast.toast(content, {
        title: `ERROR!`,
        headerClass: 'font-weight-bold',
        variant: 'danger',
        solid: true,
        autoHideDelay: 1000,
        toaster: 'b-toaster-top-right'
      })
    }
  }
});
import './filter/filter';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('review-action', require('./components/CompanyDetailReviewAction.vue').default);
Vue.component('home-search', require('./components/HomeSearch.vue').default);
Vue.component('user-dashboard', require('./components/UserDashboard.vue').default);
Vue.component('company-dashboard', require('./components/CompanyDashboard.vue').default);
Vue.component('company-login', require('./components/CompanyLogin.vue').default);
Vue.component('company-register', require('./components/CompanyRegister.vue').default);
Vue.component('company-profile-image', require('./components/CompanyProfileImage.vue').default);
Vue.component('user-profile-image', require('./components/UserProfileImage.vue').default);
Vue.component('user-write-review', require('./components/UserWriteReview.vue').default);
Vue.component('contact', require('./components/Contact.vue').default);
Vue.component('faq', require('./components/Faq.vue').default);
Vue.component('user-write-review-anycompany', require('./components/UserWriteReviewAnycompany.vue').default);
// Vue.component('sidebar-menu', require('./components/SidebarMenu.vue').default);
// Vue.component('sidebar-button', require('./components/SidebarButton.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});
// const app2 = new Vue({
//   el: '#sidebar',
// });
// const app3 = new Vue({
//   el: '#sidebar-button',
// });
