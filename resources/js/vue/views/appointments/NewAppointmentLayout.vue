<script setup>
import { onMounted } from "vue";
import { RouterLink, useRoute } from "vue-router";
import { useAppointmentsStore } from "../../store/appointment";

const appointment = useAppointmentsStore();
const route = useRoute();

onMounted(() => {
    appointment.clearAppointmentData();
});
</script>

<template>
    <div class="w-4/5 lg:w-1/2 m-auto my-5">
        <nav class="my-5 flex flex-col md:flex-row gap-3">
            <RouterLink
                :to="{ name: 'new-appointment' }"
                class="flex-1 text-center p-3 font-extrabold hover:bg-blue-600 hover:text-white border border-gray-200"
                :class="
                    route.name === 'new-appointment'
                        ? 'bg-blue-600 text-white'
                        : 'bg-white text-blue-500'
                "
                >Servicios
            </RouterLink>
            <RouterLink
                :to="{ name: 'appointment-details' }"
                class="flex-1 text-center p-3 font-extrabold hover:bg-blue-600 hover:text-white border border-gray-200"
                :class="
                    route.name === 'appointment-details'
                        ? 'bg-blue-600 text-white'
                        : 'bg-white text-blue-500'
                "
                >Cita y resumen
            </RouterLink>
        </nav>

        <div class="space-y-5">
            <RouterView />
        </div>
    </div>
</template>
