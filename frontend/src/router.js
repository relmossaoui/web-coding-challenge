import Vue from 'vue'
import Router from 'vue-router'
import SignUp from './components/SignUp.vue'
import SignIn from './components/SignIn.vue'
import Shops from './components/Shops.vue'
import PreferredShops from "./components/PreferredShops";

import { loggedGuard } from './guard.js'
import { NotLoggedGuard } from './guard.js'

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/signup',
      name: 'signup',
      beforeEnter: NotLoggedGuard,
      component: SignUp
    },

    {
      path: '/signin',
      name: 'signin',
      beforeEnter: NotLoggedGuard,
      component: SignIn
    },

    {
      path: '/shops',
      name: 'shops',
      beforeEnter: loggedGuard,
      component: Shops
    },
    {
      path: '/shops/preferred',
      name: 'shops-preferred',
      beforeEnter: loggedGuard,
      component: PreferredShops
    },
    {
      path: "*",
      redirect: "/shops"
    }
  ]
})
