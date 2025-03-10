import { computed, onMounted, ref, inject } from "vue";
import { useRouter } from "vue-router";
import { defineStore } from "pinia";
import AuthAPI from "../api/AuthAPI";
import AdminAPI from "../api/AdminAPI";

export const useAdminStore = defineStore("admin", () => {
    const admin = ref({});
    const appointments = ref([]);
    const services = ref([]);
    const loading = ref(true);
    const currentPage = ref(1);
    const totalPages = ref(1);
    const totalServices = ref(0);

    const toast = inject("toast");
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

    async function getServices() {
        const { data } = await AdminAPI.getServices(currentPage.value);
        services.value = data.data;
        totalPages.value = data.meta.last_page;
        totalServices.value = data.meta.total;
    }

    async function prevServices() {
        if (currentPage.value > 1) {
            currentPage.value = currentPage.value - 1;
            await getServices();
        }
    }
    async function nextServices() {
        if (currentPage.value < totalPages.value) {
            currentPage.value++;
            await getServices();
        }
    }

    async function saveService(service) {
        try {
            const { data } = await AdminAPI.saveService(service);
            await getServices();
            toast.open({
                type: "success",
                message: data.message,
            });
            router.push({ name: "admin-services-list" });
        } catch (error) {
            toast.open({
                message: Object.values(error.response.data.errors),
                type: "error",
            });
        }
    }

    async function updateAvailabilityService(id) {
        try {
            const { data } = await AdminAPI.updateAvailabilityService(id);
            await getServices();
            toast.open({
                type: "success",
                message: data.message,
            });
        } catch (error) {
            console.log(error);
        }
    }

    async function updateService(id, formData) {
        try {
            await AdminAPI.updateService(id, formData);
            toast.open({
                type: "success",
                message: "El servicio ha sido actualizado correctamente",
            });
            await getServices();
            router.push({ name: "admin-services-list" });
        } catch (error) {
            console.log(error);

            toast.open({
                message: error.response.data.errors,
                type: "error",
            });
        }
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
        services,
        currentPage,
        totalPages,
        totalServices,
        saveService,
        updateAvailabilityService,
        updateService,
        logout,
        prevServices,
        nextServices,
        getAdminName,
        getServices,
        noAppointments,
    };
});
