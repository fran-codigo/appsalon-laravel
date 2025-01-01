export default {
    path: "/admin",
    name: "admin",
    component: () => import("../views/admin/AdminLayout.vue"),
    children: [
        {
            path: "",
            name: "admin-appointments",
            component: () => import("../views/admin/AppointmentsView.vue"),
        },
    ],
};
