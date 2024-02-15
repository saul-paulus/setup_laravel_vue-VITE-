import './bootstrap';


import { createApp } from 'vue';
import Home from "./src/components/App.vue";

const app = createApp();

app.component('home', Home);

app.mount("#app")
