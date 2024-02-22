import axios from "axios";
import store from "../store";

const axiosClient = axios.create({
  baseURL: "http://127.0.0.1:8000/api/v1",
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
});

const token = localStorage.getItem('access_token');

if(token){
  axiosClient.defaults.headers.common['Authorization'] = `${token}`;
}

axiosClient.defaults.withCredentials = true;


axiosClient.interceptors.request.use(
  function (config) {
    config.headers.Authorization = `Bearer ${store.state.user.token}`
    return config;
  },
  function (error) {
    return Promise.reject(error);
  },
);

export default axiosClient;
