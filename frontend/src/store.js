import Vue from 'vue'
import Vuex from 'vuex'
import { http } from './config/index.js';
import router from './router.js'

Vue.use(Vuex)

const defaultMessage =  {'status' : false, 'message': "Oooops! something wrong ..."};

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

    SET_MESSAGE(state, message = defaultMessage) {
      state.message = message

      setTimeout(function() {
        state.message = null;
      }
      , 3000)
    }
  },

  actions: {
    async login ({commit}, options) {
      commit('LOGIN');
      try {
        let response = await http('post', 'signin', options.credentials);

        if (response.data.status) {
          commit('LOGIN_SUCCESS', response.data.token)

          router.push({name: 'shops'});
        } else {
          commit('LOGIN_FAILED')
          commit('SET_MESSAGE', response.data)
        }
      } catch (error) {
        commit('LOGIN_FAILED')
        commit('SET_MESSAGE')
      }
    },

    logout({commit}) {
      commit('LOGIN_OUT')

      router.push({name: 'signin'});
    }
  }
})
