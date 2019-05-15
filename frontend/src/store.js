import Vue from 'vue'
import Vuex from 'vuex'
import { http } from './config/index.js';
import router from './router.js'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLogged : !!localStorage.getItem('token'),
    pending : false,
    loginErrorMessage: ''
  },

  mutations: {
    LOGIN (state) {
      state.pending = true;
      state.isLogged = false
    },
    LOGIN_SUCCESS(state, token) {
      state.pending = false;
      state.isLogged = true;
      localStorage.setItem('token', token)
      state.loginErrorMessage = ''
    },
    LOGIN_FAILED(state, message) {
      state.pending = false;
      state.isLogged = false;
      state.loginErrorMessage = message;
    },
    LOGIN_OUT(state) {
      localStorage.removeItem('token')
      state.isLogged = false;
    }
  },
  actions: {
    async login ({commit}, options) {
      commit('LOGIN');
      try {
        let response = await http('post', 'signin', options.credentials);

        commit('LOGIN_SUCCESS', response.data.token)

        router.push({name: 'shops'});

      } catch (error) {
        commit('LOGIN_FAILED', error.response.data.message)
      }
    },

    logout({commit}) {
      commit('LOGIN_OUT')

      router.push({name: 'signin'});
    }
  }
})
