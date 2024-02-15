import './bootstrap';


import { createApp } from 'vue';
import App from "./src/App.vue";
import router from './src/router/routers';
import { createPinia } from 'pinia';
import axios from './src/plugins/axios';

const app = createApp();
const pinia = createPinia();

app.component('app', App);
app.use(router)
app.use(pinia)
app.provide(axios)
app.mount("#app")
