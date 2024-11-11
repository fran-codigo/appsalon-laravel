import "./bootstrap";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { plugin, defaultConfig } from "@formkit/vue";
import { useToast } from "vue-toast-notification";
import config from "../../formkit.config";

import App from "./vue/App.vue";
import router from "./vue/router";
import "vue-toast-notification/dist/theme-bootstrap.css";

const $toast = useToast({
    duration: 3500,
    position: "top-right",
});

const app = createApp(App);

app.provide('toast', $toast)
app.use(ZiggyVue);
app.use(createPinia());
app.use(plugin, defaultConfig(config));
app.use(router);
app.mount("#app");
