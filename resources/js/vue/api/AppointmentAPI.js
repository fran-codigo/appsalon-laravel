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
};
