import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
Vue.use(axios)
Vue.config.debug = true



export const store = new Vuex.Store({
  state: {
      markers: []
  },
  getters: {
    getMarkers(state){
      return state.markers
    },

  },
  actions: {
    allMarkers(context){
      axios.post('/request')
        .then((response) => {
          context.commit('markers', response.data.markers)
        })
      // Event.$on('store', (id) => {
      //   axios({
      //     method: 'post',
      //     url: '/request',
      //     data: markers = this.markers, id
      //   }).then(response => {
      //     this.markers = response.data
      //   });
      //   context.commit("markers", this.markers)
      // })
      
    }
  },
  mutations: {
    markers(state, data) {
      return state.markers = data
    }
  }
})