import api from "../lib/axios";

export default {
    register(data) {
        return api.post(route('register.user'), data);
    },
};
