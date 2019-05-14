import Vue from 'vue'
import Router from 'vue-router'
import SignUp from './components/SignUp.vue'
import SignIn from './components/SignIn.vue'
import Shops from './components/Shops.vue'
import store from './store.js'


Vue.use(Router);

function loggedGuard(to, from, next){
  if(store.state.isLogged) {
    next();
  } else{
    next('/signin');
  }
}

function NotoggedGuard(to, from, next){
  if(! store.state.isLogged) {
    next();
  } else{
    next('/shops');
  }
}

export default new Router({
  routes: [
    {
      path: '/signup',
      name: 'signup',
      beforeEnter: NotoggedGuard,
      component: SignUp
    },

    {
      path: '/signin',
      name: 'signin',
      beforeEnter: NotoggedGuard,
      component: SignIn
    },

    {
      path: '/shops',
      name: 'shops',
      beforeEnter: loggedGuard,
      component: Shops
    },
  ]
})
