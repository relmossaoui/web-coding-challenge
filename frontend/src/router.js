import Vue from 'vue'
import Router from 'vue-router'
import SignUp from './components/SignUp.vue'
import SignIn from './components/SignIn.vue'
import Shops from './components/Shops.vue'


Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/signup',
      name: 'signup',
      component: SignUp
    },

    {
      path: '/signin',
      name: 'signin',
      component: SignIn
    },
    ,
    {
      path: '/shops',
      name: 'shops',
      component: Shops
    },
  ]
})
