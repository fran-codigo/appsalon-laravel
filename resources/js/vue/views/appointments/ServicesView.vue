<script setup>
import { onMounted } from "vue";
import { useServicesStore } from "../../store/service";
import ServiceItem from "../../components/appointments/ServiceItem.vue";

const services = useServicesStore();

onMounted(async () => {
    await services.getServices();
});
</script>

<template>
    <div class="">
        <h2 class="text-3xl font-extrabold mt-10">Servicios</h2>
        <p class="text-lg mt-5">Elige al menos un servicio para tu cita</p>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 mt-5">
            <ServiceItem
                v-for="service in services.services"
                :key="service.id"
                :service="service"
            />
        </div>
    </div>
</template>
