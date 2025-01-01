<script setup>
import AdminAppointment from "../../components/admin/AdminAppointment.vue";
</script>

<template>
    <p class="text-lg mt-5">
        A continuación podrás administrar tus proximas citas
    </p>

    <p class="text-2xl text-center mt-5">Cargando...</p>

    <div class="">
        <p class="text-2xl text-center mt-5">No tienes próximas citas</p>

        <div class="grid grid-cols-1 gap-5 mt-5">
            <AdminAppointment />
        </div>
    </div>
</template>
