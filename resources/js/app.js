import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import App from "./vue/App.vue";
import router from "./vue/router";

const app = createApp(App);

app.use(ZiggyVue);
app.use(createPinia());
app.use(router);
app.mount("#app");
