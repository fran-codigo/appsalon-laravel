<script setup>
import { useAppointmentsStore } from "../../store/appointment";
import { formatCurrency } from "../../utils";

const appointment = useAppointmentsStore();

defineProps({
    service: {
        type: Object,
    },
});
</script>

<template>
    <div
        class="border border-gray-600 rounded-lg p-5 flex justify-between items-center"
    >
        <div class="">
            <p class="text-xl font-extrabold">{{ service.name }}</p>
            <p class="text-2xl font-black text-blue-500">
                {{ formatCurrency(service.price) }}
            </p>
        </div>
    </div>
</template>
