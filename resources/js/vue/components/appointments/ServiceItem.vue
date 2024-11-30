<script setup>
import { formatCurrency } from "../../utils";

defineProps({
    service: {
        type: Object,
    },
});
</script>

<template>
    <div
        class="p-5 space-y-5 rounded-lg cursor-pointer border shadow-sm hover:bg-blue-500 hover:text-white"
    >
        <p class="text-2xl font-light">{{ service.name }}</p>

        <p class="text-3xl font-black">{{ formatCurrency(service.price) }}</p>
    </div>
</template>
