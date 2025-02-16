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
    saveService(service) {
        return api.post(route("services.store"), service);
    },
    updateAvailabilityService(id) {
        return api.put(route("services.update-availability", id));
    },
};
