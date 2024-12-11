import { ref, onMounted, computed } from "vue";
import { defineStore } from "pinia";
import AuthAPI from "../api/AuthAPI";
import AppointmentAPI from "../api/AppointmentAPI";

export const useUsersStore = defineStore("users", () => {
    const user = ref({});
    const userAppointments = ref([]);
    const loading = ref(true);

    onMounted(async () => {
        try {
            const { data } = await AuthAPI.auth();
            user.value = data;
            await getUserAppointments();
        } catch (error) {
            console.log(error);
        } finally {
            loading.value = false;
        }
    });

    async function getUserAppointments() {
        if (user.value && user.value.id) {
            const { data } = await AppointmentAPI.getUserAppointments();
            userAppointments.value = data.data;
        }
    }

    const getUserName = computed(() =>
        user.value?.name ? user.value?.name : ""
    );

    const noAppointments = computed(() => userAppointments.value.length === 0);

    return {
        user,
        loading,
        userAppointments,
        getUserName,
        noAppointments,
    };
});
