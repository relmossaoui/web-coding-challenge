import Vue from 'vue'
import Vuex from 'vuex'
import {API_ENDPOINT_BASE} from './config/index.js';

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
          let response = await options.vm.$http.post(`${API_ENDPOINT_BASE}signin`,
              options.credentials,
              {
                headers : {
                  'Content-type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest'
                }
              }
          );

          commit('LOGIN_SUCCESS', response.data.token)

        options.vm.$router.push({name: 'shops'});

      } catch (error) {
        commit('LOGIN_FAILED', error.response.data.message)
      }
    },

    logout({commit}, options) {
      commit('LOGIN_OUT')

      options.vm.$router.push({name: 'signin'});
    }
  }
})
