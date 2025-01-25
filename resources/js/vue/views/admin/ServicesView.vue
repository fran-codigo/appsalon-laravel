<script setup>
import { onMounted } from "vue";
import { useAdminStore } from "../../store/admin";
import AdminServiceTable from "../../components/admin/AdminServiceTable.vue";

const admin = useAdminStore();

onMounted(async () => {
    await admin.getServices();
});
</script>

<template>
    <p class="text-lg mt-5">A continuación podrás administrar tus servicios</p>

    
    
    <AdminServiceTable :services="admin.services" />
</template>
