import { computed, onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { defineStore } from "pinia";
import AuthAPI from "../api/AuthAPI";
import AdminAPI from "../api/AdminAPI";

export const useAdminStore = defineStore("admin", () => {
    const admin = ref({});
    const appointments = ref([]);
    const loading = ref(true);

    const router = useRouter();

    onMounted(async () => {
        try {
            const { data } = await AuthAPI.auth();
            admin.value = data;
            await getAppointments();
        } catch (error) {
            console.log(error);
        } finally {
            loading.value = false;
        }
    });

    async function getAppointments() {
        const { data } = await AdminAPI.getAppointments();
        appointments.value = data.data.data;
    }

    function logout() {
        localStorage.removeItem("AUTH_TOKEN");
        admin.value = {};
        router.push({ name: "login" });
    }

    const getAdminName = computed(() =>
        admin.value?.name ? admin.value?.name : ""
    );

    const noAppointments = computed(() => appointments.value.length === 0);

    return {
        admin,
        loading,
        appointments,
        logout,
        getAdminName,
        noAppointments
    };
});
