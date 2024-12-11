<script setup>
import { useUsersStore } from "../../store/users";
import Appointment from "../../components/appointments/Appointment.vue";

const user = useUsersStore();
</script>

<template>
    <div class="w-4/5 lg:w-1/2 m-auto my-5">
        <h2 class="text-3xl font-extrabold mt-10">Mis Citas</h2>
        <p class="text-lg mt-5">
            A continuación puedes administrar tus propias citas
        </p>

        <p v-if="user.loading" class="text-xl text-center">Cargando...</p>
        <div class="" v-else>
            <p v-if="user.noAppointments" class="text-xl text-center mt-5">
                No tienes citas pendientes
            </p>

            <div v-else class="grid md:grid-cols-2 gap-5 mt-5">
                <Appointment
                    v-for="appointment in user.userAppointments"
                    :key="appointment.id"
                    :appointment="appointment"
                />
            </div>
        </div>
    </div>
</template>
