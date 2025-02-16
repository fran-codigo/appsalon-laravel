import api from "../lib/axios";

export default {
    auth() {
        return api.get(route("admin.index"));
    },
    getAppointments() {
        return api.get(route("admin.appointments"));
    },
    getServices(page) {
        return api.get(route("admin.services"), {
            params: {
                page,
            },
        });
    },
};
