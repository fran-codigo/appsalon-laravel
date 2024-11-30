import { ref } from "vue";
import { defineStore } from "pinia";
import ServiceAPI from "../api/ServiceAPI";

export const useServicesStore = defineStore("services", () => {
    const services = ref([]);

    async function getServices() {
        const { data } = await ServiceAPI.all();
        services.value = data.data;
    }

    return {
        services,
        getServices,
    };
});
