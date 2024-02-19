import { createStore, mapState } from "vuex";

const store = createStore({
  state: {
    user: {
      data: {
        idPersonal: "007100",
        username: "Saul Paulus",
        imgUrl: "https://flowbite.com/docs/images/logo.svg",
      },
      token: "1219082ndhdua121",
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
