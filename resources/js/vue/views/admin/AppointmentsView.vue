<script setup>
import { useAdminStore } from "../../store/admin";
import AdminAppointment from "../../components/admin/AdminAppointment.vue";

const admin = useAdminStore();
</script>

<template>
    <p class="text-lg mt-5">
        A continuación podrás administrar tus proximas citas
    </p>

    <p v-if="admin.loading" class="text-2xl text-center mt-5">Cargando...</p>

    <div class="">
        <p v-if="admin.noAppointments" class="text-2xl text-center mt-5">
            No tienes próximas citas
        </p>

        <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
            <AdminAppointment
                v-for="appointment in admin.appointments"
                :appointment="appointment"
            />
        </div>
    </div>
</template>
