import api from "../lib/axios";

export default {
    auth() {
        return api.get(route("admin.index"));
    },
};
