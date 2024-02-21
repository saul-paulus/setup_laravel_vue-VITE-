import { createStore, mapState } from "vuex";

const store = createStore({
  state: {
    user: {
      data: {
        personalNumber: "007100",
        username: "Saul Paulus",
      },
      token: null,
    },
  },
  getters: {},
  actions: {},
  mutations: {
    logout: (state) => {
      state.user.data = {};
      state.user.token = null;
    },
  },
  modules: {},
});

export default store;
