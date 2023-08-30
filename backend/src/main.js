import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import {
    Menu,
    List,
    Drawer,
    Button,
    message,
    Card,
    Table,
    Avatar,
    Input,
    Select,
} from "ant-design-vue";
import "ant-design-vue/dist/reset.css";
import axios from "axios";
import App from "./App.vue";

import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import "./static/fontawesome/css/all.min.css";

window.axios = axios;
const app = createApp(App);
app.use(router);
app.use(createPinia());
app.use(Menu);
app.use(Avatar);
app.use(Input);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Card);
app.use(Table);
app.use(Select);

app.mount("#app");
app.config.globalProperties.$message = message;
