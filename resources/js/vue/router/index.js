import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import NotFoundView from "../views/NotFoundView.vue";
import AdminRoutes from "./admin";
import { adminGuard, authGuard } from "./guards";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", component: HomeView },
        {
            ...AdminRoutes,
        },
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
                {
                    path: "confirmar-cuenta/:token",
                    name: "confirm-account",
                    component: () =>
                        import("../views/auth/ConfirmAccountView.vue"),
                },
                {
                    path: "olvide-password",
                    name: "forgot-password",
                    component: () =>
                        import("../views/auth/ForgotPasswordView.vue"),
                },
                {
                    path: "olvide-password/:token",
                    name: "new-password",
                    component: () =>
                        import("../views/auth/NewPasswordView.vue"),
                },
            ],
        },
        {
            path: "/reservaciones",
            name: "appointments",
            component: () =>
                import("../views/appointments/AppointmentsLayout.vue"),
            meta: { requiresAuth: true },
            children: [
                {
                    path: "",
                    name: "my-appointments",
                    component: () =>
                        import("../views/appointments/MyAppointmentsView.vue"),
                },
                {
                    path: "nueva",
                    component: () =>
                        import(
                            "../views/appointments/NewAppointmentLayout.vue"
                        ),
                    children: [
                        {
                            path: "",
                            name: "new-appointment",
                            component: () =>
                                import(
                                    "../views/appointments/ServicesView.vue"
                                ),
                        },
                        {
                            path: "detalles",
                            name: "appointment-details",
                            component: () =>
                                import(
                                    "../views/appointments/AppointmentView.vue"
                                ),
                        },
                    ],
                },
                {
                    path: ":id/editar",
                    component: () =>
                        import(
                            "../views/appointments/EditAppointmentLayout.vue"
                        ),
                    children: [
                        {
                            path: "",
                            name: "edit-appointment",
                            component: () =>
                                import(
                                    "../views/appointments/ServicesView.vue"
                                ),
                        },
                        {
                            path: "detalles",
                            name: "edit-appointment-details",
                            component: () =>
                                import(
                                    "../views/appointments/AppointmentView.vue"
                                ),
                        },
                    ],
                },
            ],
        },
        { path: "/:pathMatch(.*)*", component: NotFoundView },
    ],
});

router.beforeEach((to, from, next) => {
    authGuard(to, from, next);
});

router.beforeEach((to, from, next) => {
    adminGuard(to, from, next);
});

export default router;
