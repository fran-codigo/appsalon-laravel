import api from "../lib/axios";

export default {
    register(data) {
        return api.post(route("register.user"), data);
    },
    login(data) {
        return api.post(route("login.user"), data);
    },
    verifyAccount(token) {
        return api.get(route("verify.user", { token }), {
            params: { token },
        });
    },
};
