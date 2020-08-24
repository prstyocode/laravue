import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    notificationCounter: 0
  },
  mutations: {
    increment(state) {
      state.notificationCounter++;
    }
  },
  getters: {
    notificationCounter: state => state.notificationCounter
  }
});
