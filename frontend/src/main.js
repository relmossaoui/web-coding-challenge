import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

import guards from './guard.js'

import './registerServiceWorker'
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.prototype.$http = axios

Vue.config.productionTip = false

router.beforeEach(guards)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
