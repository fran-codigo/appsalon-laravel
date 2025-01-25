<script setup>
import {onMounted} from "vue";
import { useServicesStore } from "../../store/service";

const service = useServicesStore();

onMounted(async () => {
  await service.getServices()
})

</script>

<template>
    <p class="text-lg mt-5">A continuación podrás administrar tus servicios</p>

    <div v-for="service in service.services" class="p-10">
        <div class="">{{service}}</div>
    </div>
</template>
