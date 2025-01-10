import AdminAPI from "../api/AdminAPI";
import AuthAPI from "../api/AuthAPI";

export async function authGuard(to, from, next) {
    const requiresAuth = to.matched.some((url) => url.meta.requiresAuth);
    if (requiresAuth) {
        try {
            const { data } = await AuthAPI.auth();
            if (data.role_id === 2) {
                next({ name: "admin-appointments" });
            } else {
                next();
            }
        } catch (error) {
            next({ name: "login" });
        }
    } else {
        next();
    }
}

export async function adminGuard(to, from, next) {
    const requiresAdmin = to.matched.some((url) => url.meta.requiresAdmin);
    if (requiresAdmin) {
        try {
            await AdminAPI.auth();
            next();
        } catch (error) {
            next({ name: "login" });
        }
    } else {
        next();
    }
}
