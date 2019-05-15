import Vue from 'vue'
import Router from 'vue-router'
import SignUp from './components/SignUp.vue'
import SignIn from './components/SignIn.vue'
import Shops from './components/Shops.vue'
import PreferredShops from "./components/PreferredShops";

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/signup',
      name: 'signup',
      meta: { notRequiresAuth: true },
      component: SignUp
    },

    {
      path: '/signin',
      name: 'signin',
      meta: { notRequiresAuth: true },
      component: SignIn
    },

    {
      path: '/shops',
      name: 'shops',
      meta: { requiresAuth: true },
      component: Shops
    },
    {
      path: '/shops/preferred',
      name: 'shops-preferred',
      meta: { requiresAuth: true },
      component: PreferredShops
    },
    {
      path: "*",
      redirect: "/shops"
    }
  ]
})
