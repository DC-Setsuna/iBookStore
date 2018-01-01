import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  state: {
    car_count: 1,
    loginDialogVisible: false,
    islogin: false,
    API: 'http://localhost/',
    // API: 'https://www.importdc.com/',
    username: ''
    
  },
  mutations: {
    loginDialog(state) {
      state.loginDialogVisible = !state.loginDialogVisible
    },
    login(state, username) {
      state.islogin = true
      state.username = username
    },
    addcar(state, count) {
      state.car_count = count
    },
    quit(state) {
    	state.islogin = false
    	state.username = ''
    }
  }
})
