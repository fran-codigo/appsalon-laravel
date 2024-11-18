import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import NotFoundView from "../views/NotFoundView.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: HomeView },
        {
            path: "/auth",
            name: "auth",
            component: () => import("../views/auth/AuthLayout.vue"),
            children: [
                {
                    path: "registro",
                    name: "register",
                    component: () => import("../views/auth/RegisterView.vue"),
                },
                {
                    path: "login",
                    name: "login",
                    component: () => import("../views/auth/LoginView.vue"),
                },
            ],
        },
        {
            path: "/reservaciones",
            name: "appointments",
            component: () =>
                import("../views/appointments/AppointmentsLayout.vue"),
            children: [
                {
                    path: "",
                    name: "my-appointments",
                    component: () =>
                        import("../views/appointments/AppointmentsView.vue"),
                },
            ],
        },
        { path: "/:pathMatch(.*)*", component: NotFoundView },
    ],
});

export default router;
