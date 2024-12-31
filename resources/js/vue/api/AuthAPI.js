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
    auth() {
        return api.get(route("user.index"));
    },
    forgotPassword(data) {
        return api.post(route("forgot.password"), data);
    },
    verifyPasswordResetToken(token) {
        return api.get(route("verify.password.reset.token", { token }), {
            params: { token },
        });
    },
    updatePassword(token, data) {
        return api.put(route("update.password", { token }), data);
    },
};
