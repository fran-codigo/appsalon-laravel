<script setup>
import { onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAppointmentsStore } from "../../store/appointment";
import AppointmentAPI from "../../api/AppointmentAPI";

const appointment = useAppointmentsStore();
const route = useRoute();
const router = useRouter();

const { id } = route.params;

onMounted(async () => {
    try {
        const { data } = await AppointmentAPI.getById(id);
        appointment.setSelectedAppointment(data.data);
    } catch (error) {
        router.push({ name: "my-appointments" });
    }
});
</script>

<template>
    <div class="w-4/5 lg:w-1/2 m-auto my-5">
        <nav class="my-5 flex flex-col md:flex-row gap-3">
            <RouterLink
                :to="{ name: 'edit-appointment' }"
                class="flex-1 text-center p-3 font-extrabold hover:bg-blue-600 hover:text-white border border-gray-200"
                :class="
                    route.name === 'edit-appointment'
                        ? 'bg-blue-600 text-white'
                        : 'bg-white text-blue-500'
                "
                >Servicios
            </RouterLink>
            <RouterLink
                :to="{ name: 'edit-appointment-details' }"
                class="flex-1 text-center p-3 font-extrabold hover:bg-blue-600 hover:text-white border border-gray-200"
                :class="
                    route.name === 'edit-appointment-details'
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
