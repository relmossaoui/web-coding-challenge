import Vue from 'vue'
import Vuex from 'vuex'
import { http } from './config/index.js';
import router from './router.js'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isLogged : !!localStorage.getItem('token'),
    pending : false,
    message: null
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
    },

    LOGIN_FAILED(state) {
      state.pending = false;
      state.isLogged = false;
    },

    LOGIN_OUT(state) {
      localStorage.removeItem('token')
      state.isLogged = false;
    },
    
    SET_MESSAGE(state, message) {
      state.message = message

      setTimeout(function() {
        state.message = null;
      }
      , 2000)
    },
    CLEAR_MESSAGE(state) {
      state.message = null
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
        commit('LOGIN_FAILED')
        commit('SET_MESSAGE', error.response.data)
      }
    },

    logout({commit}) {
      commit('LOGIN_OUT')

      router.push({name: 'signin'});
    }
  }
})
