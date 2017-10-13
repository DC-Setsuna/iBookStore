import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
	state: {
		loginDialogVisible: false
	},
	mutations: {
		loginDialog(state) {
			state.loginDialogVisible = !state.loginDialogVisible
		}
	}
})