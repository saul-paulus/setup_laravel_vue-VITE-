import "./bootstrap";
import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from "vue";
import App from "./src/App.vue";
import router from "./src/router/routers";
import axios from "./src/plugins/axios";
import store from "./src/store";


const app = createApp();

app.component("app", App);
app.use(router);
app.use(store);
app.provide(axios);
app.mount("#app");
