import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import NotFoundView from "../views/NotFoundView.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: HomeView },
        {
            path: "/login",
            component: () => import("../views/auth/LoginView.vue"),
        },
        { path: "/:pathMatch(.*)*", component: NotFoundView },
    ],
});

export default router;
