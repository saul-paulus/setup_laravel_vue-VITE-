import { createStore, mapState } from "vuex";
import axiosClient from "../plugins/axios";

const store = createStore({
  state: {
    user: {
      data: {},
      token: localStorage.getItem('access_token') || '' || null,
    },
  },
  getters: {
    user: (state) => {
      return state.user.data
    }
  },
  actions: {
    authLogin({commit}, user){
      return new Promise((resolve, reject) => {
        axiosClient.post('/gate/auth/login', user)
        .then((data)=> {
          const dataResponse = data.data;

          if(dataResponse.statusCode == 200){
            const token = dataResponse.token;
            localStorage.setItem('access_token',token);

            commit('loginSuccess', dataResponse);
            resolve(dataResponse);

          }else{
            localStorage.removeItem('access_token')
            commit('loginFail');
            window.location.reload();
            resolve(dataResponse);
          }
        })
        .catch(error => {
          commit('loginFailure');
          localStorage.removeItem('access_token');
          reject(error)
        });
      })

    },

    logout({commit}){
      return new Promise((resolve, reject)=>{
        axiosClient.get('/gate/auth/logout')
        .then(()=>{
          commit('successLogout');
          localStorage.removeItem('access_token');
          delete axiosClient.defaults.headers.common['Authrization'];
          resolve();
        })
        .catch(error => {
          reject(error);
        })

      })
    },

    checkToken({commit}, authToken){
      return axiosClient.post('/gate/auth/check-token', authToken)
      .then(()=> {
        return;
      })
      .catch((error) => {
        commit('loginFail');
        localStorage.removeItem('access_token');
        return error;
      });
    },

    getUser({commit}){
      return new Promise((resolve, reject) => {
        axiosClient.get('/gate/auth/user')
        .then((response) =>{
          const data = response.data;
          commit('userData', data)
          resolve(data)
        })
        .catch(error=>{
          reject(error)
        })
      });
    }

  },
  mutations: {
    loginSuccess: (state, user) =>{
      state.user.token = user.token;
      state.user.data = user.data;
    },
    loginFail: (state) =>{
      state.user.token = null;
      state.user.data = {};
    },
    userData: (state, user) => {
      state.user.data = user.data;
    },
    successLogout: (state) => {
      state.user.data = {};
      state.user.token = null;
    },
  },
  modules: {},
});

export default store;

