/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
window.Vue = require('vue').default;
window.EventBus = new Vue();

var Lang = require('lang.js');
import source from "./lang/localization"
var lang = new Lang({
  messages: source,
  locale: 'tr',
});
Vue.prototype.$lang = lang
Vue.filter('trans', (...args) => {
  return lang.get(...args);
});

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


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// Vue.component('review-action', require('./components/CompanyDetailReviewAction.vue').default);
// Vue.component('common-words', require('./components/CommonWords.vue').default);
// Vue.component('home-search', require('./components/HomeSearch.vue').default);
// Vue.component('home-top-company', require('./components/HomeTopCompany.vue').default);
// Vue.component('user-dashboard', require('./components/UserDashboard.vue').default);
// Vue.component('company-dashboard', require('./components/CompanyDashboard.vue').default);
// Vue.component('company-login', require('./components/CompanyLogin.vue').default);
// Vue.component('user-login', require('./components/UserLogin.vue').default);
// Vue.component('company-register', require('./components/CompanyRegister.vue').default);
// Vue.component('user-register', require('./components/UserRegister.vue').default);
// Vue.component('company-profile-image', require('./components/CompanyProfileImage.vue').default);
// Vue.component('user-profile-image', require('./components/UserProfileImage.vue').default);
// Vue.component('user-write-review', require('./components/UserWriteReview.vue').default);
// Vue.component('contact', require('./components/Contact.vue').default);
// Vue.component('navbar', require('./components/Navbar.vue').default);
// Vue.component('faq', require('./components/Faq.vue').default);
// Vue.component('user-write-review-anycompany', require('./components/UserWriteReviewAnycompany.vue').default);



// Vue.component('sidebar-menu', require('./components/SidebarMenu.vue').default);
// Vue.component('sidebar-button', require('./components/SidebarButton.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  components: {

    'review-action': () => import(
      './components/CompanyDetailReviewAction.vue'
    ),
    'common-words': () => import(
      './components/CommonWords.vue'
    ),
    'home-search': () => import(
      './components/HomeSearch.vue'
    ),
    'home-top-company': () => import(
      './components/HomeTopCompany.vue'
    ),
    'user-dashboard': () => import(
      './components/UserDashboard.vue'
    ),
    'company-dashboard': () => import(
      './components/CompanyDashboard.vue'
    ),
    'company-login': () => import(
      './components/CompanyLogin.vue'
    ),
    'user-login': () => import(
      './components/UserLogin.vue'
    ),
    'company-register': () => import(
      './components/CompanyRegister.vue'
    ),
    'user-register': () => import(
      './components/UserRegister.vue'
    ),
    'company-profile-image': () => import(
      './components/CompanyProfileImage.vue'
    ),
    'user-profile-image': () => import(
      './components/UserProfileImage.vue'
    ),
    'user-write-review': () => import(
      './components/UserWriteReview.vue'
    ),
    'contact': () => import(
      './components/Contact.vue'
    ),
    'navbar': () => import(
      './components/Navbar.vue'
    ),
    'faq': () => import(
      './components/Faq.vue'
    ),
    'user-write-review-anycompany': () => import(
      './components/UserWriteReviewAnycompany.vue'
    )

  }
});
// const app2 = new Vue({
//   el: '#sidebar',
// });
// const app3 = new Vue({
//   el: '#sidebar-button',
// });
