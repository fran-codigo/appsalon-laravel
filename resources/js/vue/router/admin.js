export default {
    path: "/admin",
    name: "admin",
    component: () => import("../views/admin/AdminLayout.vue"),
    meta: { requiresAdmin: true },
    children: [
        {
            path: "",
            name: "admin-appointments",
            component: () => import("../views/admin/AppointmentsView.vue"),
        },
        {
            path: "servicios",
            name: "admin-services",
            component: () => import("../views/admin/AdminServicesLayout.vue"),
            children: [
                {
                    path: "",
                    name: "admin-services-list",
                    component: () => import("../views/admin/ServicesView.vue"),
                },
            ],
        },
    ],
};
