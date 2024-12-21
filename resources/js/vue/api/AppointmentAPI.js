import api from "../lib/axios";

const token = localStorage.getItem("AUTH_TOKEN");

export default {
    create(data) {
        return api.post(route("appointments.store"), data, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
    },
    getByDate(date) {
        return api.get(
            route("appointments.date", {
                _query: {
                    date,
                },
            }),
            {
                headers: {
                    Authorization: `Beraer ${token}`,
                },
            }
        );
    },
    getUserAppointments() {
        return api.get(route("user.appointments"), {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
    },
    cancelAppointment(id) {
        return api.delete(
            route("appointments.destroy", {
                id,
            }),
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
    },
    getById(id) {
        return api.get(
            route("appointments.show", {
                id,
            }),
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
    },
    update(id, data) {
        return api.put(
            route("appointments.update", {
                id,
            }),
            data,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
    },
};
