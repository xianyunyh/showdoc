import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        token:'',
        uid: '',
        username: '',
        isLoadding: false
    },
    mutations: {
        setUser (state,payload) {
            state.token = payload.token;
            state.uid = payload.uid;
            state.username = payload.username;
        },
        setLodding (state, res) {
            state.isLoadding = res
        }
    },
    getters: {
        isLoadding: state => {
            return state.isLoadding
          }
    }
});
export  default store;