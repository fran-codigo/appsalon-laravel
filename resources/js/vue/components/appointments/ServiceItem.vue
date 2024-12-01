<script setup>
import { useAppointmentsStore } from "../../store/appointment";
import { formatCurrency } from "../../utils";

const appointments = useAppointmentsStore();

defineProps({
    service: {
        type: Object,
    },
});
</script>

<template>
    <div
        @click="appointments.onServiceSelected(service)"
        class="p-5 space-y-5 rounded-lg cursor-pointer border shadow-sm hover:bg-blue-500 hover:text-white"
        :class="
            appointments.isServiceSelected(service.id)
                ? 'bg-blue-500 text-white'
                : 'bg-white'
        "
    >
        <p class="text-2xl font-light">{{ service.name }}</p>

        <p class="text-3xl font-black">{{ formatCurrency(service.price) }}</p>
    </div>
</template>
