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
    ],
};
