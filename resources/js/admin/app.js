window.Vue = require('vue').default;
import App from './view/App';

import VueRouter from 'vue-router';
import router from './router';
import
store
from './store';
import './filter/filter';
import BootstrapVue from 'bootstrap-vue';
import axios from "axios";
// import InterceptorSetup from './interceptor';

require('./bootstrap');
Vue.use(BootstrapVue);
Vue.use(VueRouter);

// InterceptorSetup()
const app = new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});
