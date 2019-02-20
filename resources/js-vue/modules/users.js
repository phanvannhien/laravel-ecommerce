/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the users
*/
import axios from 'axios'
import { APP_CONFIG } from '../config.js';


const API_REGISTER = APP_CONFIG.API_URL + '/register' // post
const API_USER = APP_CONFIG.API_URL + '/user' // get

export const users = {
  /*
    Defines the state being monitored for the module.
  */
  state: {
    user: {},
    token: localStorage.getItem('token') || '',
  },

  /*
    Defines the actions used to retrieve the data.
  */
  actions: {

    login({ commit }, data ){
      return new Promise((resolve, reject) => {
        axios.post(APP_CONFIG.API_URL + '/login', data)
          .then( function( response ){
            localStorage.setItem('token', response.data.token)
            axios.defaults.headers.common['Authorization'] = response.data.token
            commit('auth_success', response.data.token, response.data.user)
            resolve(response)
          })
          .catch( err => {
            localStorage.removeItem('token')
            reject(err)
          });
      })
    },

    getUser({commit}){
      axios.get(APP_CONFIG.API_URL + '/user')
        .then( function(response){
          commit('setUser', response.data)
        })
    }


  },

  /*
    Defines the mutations used
  */
  mutations: {

    auth_success(state, token, user){
      state.token = token
      state.user = user
    },

    setUser( state, user ){
      state.user = user
    },

    logout(state){
        state.token = ''
    },
  },

  /*
    Defines the getters used by the module.
  */
  getters: {
    isLoggedIn: state => !!state.token,
    /*
      Returns the user.
    */
    getUser: state => state.user, 


  }
}
