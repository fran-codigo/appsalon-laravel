import api from "../lib/axios";

export default {
    create(data) {
        const token = localStorage.getItem("AUTH_TOKEN");
        return api.post(route("appointments.store"), data, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
    },
};
