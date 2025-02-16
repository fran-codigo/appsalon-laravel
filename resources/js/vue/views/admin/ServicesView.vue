<script setup>
import { onMounted } from "vue";
import { useAdminStore } from "../../store/admin";
import AdminServiceTable from "../../components/admin/AdminServiceTable.vue";
import { RouterLink } from "vue-router";

const admin = useAdminStore();

onMounted(async () => {
    await admin.getServices();
});
</script>

<template>
    <p class="text-lg mt-5">A continuación podrás administrar tus servicios</p>

    <div class="">
        <RouterLink
            :to="{ name: 'admin-services-create' }"
            class="text-lg text-white bg-blue-500 px-2 py-1 rounded-lg"
        >
            Crear servicio
        </RouterLink>
    </div>

    <AdminServiceTable :services="admin.services" />

    <div class="flex justify-end items-center gap-3">
        <button
            @click="admin.prevServices"
            :disabled="admin.currentPage <= 1"
            class="text-lg text-white bg-blue-500 px-2 py-1 rounded-lg"
            :class="admin.currentPage <= 1 ? 'opacity-50' : ''"
        >
            Anterior
        </button>
        <span class="text-base">Página {{ admin.currentPage }}</span>
        <button
            @click="admin.nextServices"
            :disabled="admin.currentPage >= admin.totalPages"
            class="text-lg text-white bg-blue-500 px-2 py-1 rounded-lg"
            :class="admin.currentPage >= admin.totalPages ? 'opacity-50' : ''"
        >
            Siguiente
        </button>
    </div>
</template>
