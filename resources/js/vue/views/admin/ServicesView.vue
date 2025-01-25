<script setup>
import { onMounted } from "vue";
import { useServicesStore } from "../../store/service";
import AdminServiceTable from "../../components/admin/AdminServiceTable.vue";

const service = useServicesStore();

onMounted(async () => {
    await service.getServices();
});
</script>

<template>
    <p class="text-lg mt-5">A continuación podrás administrar tus servicios</p>

    <AdminServiceTable :services="service.services" />
</template>
